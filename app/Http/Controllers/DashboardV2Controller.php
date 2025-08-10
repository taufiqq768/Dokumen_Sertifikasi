<?php

namespace App\Http\Controllers;

use App\Models\ProsesDokumen;
use App\Models\MasterPosisi;
use App\Models\MasterBidang;
use App\Models\MasterStatusDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardV2Controller extends Controller
{
    public function index()
    {
        // Total bidang dimohon
        $totalBidangDimohon = MasterBidang::count();

        // Data untuk cards berdasarkan posisi dengan total luas permohonan
        $posisiData = MasterPosisi::select(
            'master_posisi.*',
            DB::raw('COUNT(proses_dokumen.id) as proses_dokumen_count'),
            DB::raw('COALESCE(SUM(proses_dokumen.Luas_permohonan), 0) as total_luas_permohonan')
        )
            ->leftJoin('proses_dokumen', 'master_posisi.id', '=', 'proses_dokumen.posisi_id')
            ->groupBy('master_posisi.id', 'master_posisi.posisi', 'master_posisi.created_at', 'master_posisi.updated_at')
            ->get();

        // Data untuk status dokumen
        $statusDokumen = ProsesDokumen::select(
            'master_status_dokumen.status_dokumen',
            DB::raw('count(*) as total')
        )
            ->join('master_status_dokumen', 'proses_dokumen.status_dokumen_id', '=', 'master_status_dokumen.id')
            ->groupBy('master_status_dokumen.status_dokumen')
            ->orderByRaw("CASE 
                WHEN master_status_dokumen.status_dokumen LIKE '%Uncler%' THEN 1
                WHEN master_status_dokumen.status_dokumen LIKE '%Clear%' THEN 2
                WHEN master_status_dokumen.status_dokumen LIKE '%Telaah%' THEN 3
                ELSE 4
                END")
            ->get();

        // Data untuk status dokumen per entitas (chart)
        $statusDokumenPerEntitas = ProsesDokumen::select(
            'master_bidang.Entitas',
            'master_status_dokumen.status_dokumen',
            DB::raw('count(*) as total')
        )
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->join('master_status_dokumen', 'proses_dokumen.status_dokumen_id', '=', 'master_status_dokumen.id')
            ->groupBy('master_bidang.Entitas', 'master_status_dokumen.status_dokumen')
            ->get()
            ->groupBy('Entitas');

        // Data untuk durasi pemenuhan dokumen unclear (Fixed for SQL Server)
        $durasiDokumenUnclear = ProsesDokumen::select(
            'master_bidang.Entitas',
            DB::raw('DATEDIFF(day, proses_dokumen.tanggal_pemberitahuan, GETDATE()) as durasi_hari'),
            DB::raw('count(*) as total')
        )
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->join('master_status_dokumen', 'proses_dokumen.status_dokumen_id', '=', 'master_status_dokumen.id')
            ->where('master_status_dokumen.status_dokumen', 'LIKE', '%Uncler%')
            ->groupBy('master_bidang.Entitas', DB::raw('DATEDIFF(day, proses_dokumen.tanggal_pemberitahuan, GETDATE())'))
            ->get()
            ->groupBy('Entitas');

        // Data untuk tingkat durasi pemenuhan dokumen (Fixed for SQL Server)
        $tingkatDurasi = ProsesDokumen::select(
            DB::raw('CASE
                WHEN DATEDIFF(day, tanggal_pemberitahuan, GETDATE()) <= 30 THEN \'< 1 bulan\'
                WHEN DATEDIFF(day, tanggal_pemberitahuan, GETDATE()) <= 90 THEN \'1-3 bulan\'
                ELSE \'Selesai\'
                END as kategori_durasi'),
            DB::raw('count(*) as total')
        )
            ->groupBy(DB::raw('CASE
                WHEN DATEDIFF(day, tanggal_pemberitahuan, GETDATE()) <= 30 THEN \'< 1 bulan\'
                WHEN DATEDIFF(day, tanggal_pemberitahuan, GETDATE()) <= 90 THEN \'1-3 bulan\'
                ELSE \'Selesai\'
                END'))
            ->get();

        // Data untuk last update laporan
        $lastUpdateLaporan = ProsesDokumen::select(
            'master_bidang.Entitas',
            DB::raw('MAX(proses_dokumen.updated_at) as last_update'),
            DB::raw('count(*) as total')
        )
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->groupBy('master_bidang.Entitas')
            ->get();

        // Summary highlight
        $summaryHighlight = [
            'simulasi_ai' => 0, // Placeholder untuk fitur AI
            'tidak_clear' => $statusDokumen->where('status_dokumen', 'LIKE', '%Uncler%')->sum('total'),
            'berkas_tidak_clear_terbanyak' => $this->getBerkasUnclearTerbanyak(),
            'pemenuhan_dokumen_unclear_terlambat' => $this->getPemenuhanTerlambat(),
            'belum_telaah' => $statusDokumen->where('status_dokumen', 'LIKE', '%Belum Telaah%')->sum('total')
        ];

        return view('dashboard.v2.index', compact(
            'totalBidangDimohon',
            'posisiData',
            'statusDokumen',
            'statusDokumenPerEntitas',
            'durasiDokumenUnclear',
            'tingkatDurasi',
            'lastUpdateLaporan',
            'summaryHighlight'
        ));
    }

    private function getBerkasUnclearTerbanyak()
    {
        $result = ProsesDokumen::select(
            'master_bidang.Entitas',
            DB::raw('count(*) as total')
        )
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->join('master_status_dokumen', 'proses_dokumen.status_dokumen_id', '=', 'master_status_dokumen.id')
            ->where('master_status_dokumen.status_dokumen', 'LIKE', '%Uncler%')
            ->groupBy('master_bidang.Entitas')
            ->orderBy('total', 'desc')
            ->first();

        return $result ? $result->Entitas : 'Tidak ada data';
    }

    private function getPemenuhanTerlambat()
    {
        // Fixed for SQL Server
        $count = ProsesDokumen::join('master_status_dokumen', 'proses_dokumen.status_dokumen_id', '=', 'master_status_dokumen.id')
            ->where('master_status_dokumen.status_dokumen', 'LIKE', '%Uncler%')
            ->where(DB::raw('DATEDIFF(day, proses_dokumen.tanggal_pemberitahuan, GETDATE())'), '>', 7)
            ->count();

        return $count . ' lebih dari 1 minggu (timer)';
    }

    public function detail(Request $request)
    {
        $posisiId = $request->get('posisi_id');
        $entitas = $request->get('entitas');
        $statusDokumen = $request->get('status_dokumen');

        // Query dasar dengan join ke semua tabel master
        $query = ProsesDokumen::select(
            'proses_dokumen.*',
            'master_bidang.NIA',
            'master_bidang.Entitas',
            'master_bidang.Regional',
            'master_bidang.Kebun',
            'master_bidang.Provinsi',
            'master_bidang.Kabupaten',
            'master_bidang.Kecamatan',
            'master_bidang.Desa',
            'master_bidang.Luas_areal',
            'master_posisi.posisi',
            'master_jenis_hak.jenis_hak',
            'master_jenis_permohonan.jenis_permohonan',
            'master_status_dokumen.status_dokumen'
        )
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->join('master_posisi', 'proses_dokumen.posisi_id', '=', 'master_posisi.id')
            ->leftJoin('master_jenis_hak', 'master_bidang.Jenis_Hak', '=', 'master_jenis_hak.id')
            ->leftJoin('master_jenis_permohonan', 'master_bidang.Jenis_Permohonan', '=', 'master_jenis_permohonan.id')
            ->leftJoin('master_status_dokumen', 'proses_dokumen.status_dokumen_id', '=', 'master_status_dokumen.id');

        // Filter berdasarkan parameter
        if ($posisiId) {
            $query->where('proses_dokumen.posisi_id', $posisiId);
        }

        if ($entitas) {
            $query->where('master_bidang.Entitas', $entitas);
        }

        if ($statusDokumen) {
            $query->where('master_status_dokumen.status_dokumen', 'LIKE', '%' . $statusDokumen . '%');
        }

        // Ambil data dengan pagination
        $dokumenDetail = $query->orderBy('proses_dokumen.created_at', 'desc')->paginate(15);

        // Ambil informasi filter untuk judul
        $filterInfo = [];
        if ($posisiId) {
            $posisi = MasterPosisi::find($posisiId);
            $filterInfo['posisi'] = $posisi ? ucwords(str_replace('_', ' ', $posisi->posisi)) : 'Tidak Diketahui';
        }
        if ($entitas) {
            $filterInfo['entitas'] = $entitas;
        }
        if ($statusDokumen) {
            $filterInfo['status_dokumen'] = $statusDokumen;
        }

        return view('dashboard.v2.detail', compact('dokumenDetail', 'filterInfo'));
    }
}
