<?php

namespace App\Http\Controllers;

use App\Models\ProsesDokumen;
use App\Models\MasterPosisi;
use App\Models\MasterBidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total semua dokumen proses
        $totalDokumen = ProsesDokumen::count();

        // Ambil semua posisi dari master_posisi untuk membuat cards dinamis
        $posisiData = MasterPosisi::withCount('prosesDokumen')->get();

        // Data untuk pie chart berdasarkan entitas (dari master_bidang)
        $dokumenByEntitas = ProsesDokumen::select('master_bidang.Entitas', DB::raw('count(*) as total'))
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->groupBy('master_bidang.Entitas')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->Entitas,
                    'value' => $item->total
                ];
            });

        // Data untuk chart jenis hak berdasarkan entitas
        // Karena Jenis_Hak adalah integer yang merujuk ke master_jenis_hak.id
        $jenisHakByEntitas = ProsesDokumen::select(
            'master_bidang.Entitas',
            'master_jenis_hak.jenis_hak',
            DB::raw('count(*) as total')
        )
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->leftJoin('master_jenis_hak', 'master_bidang.Jenis_Hak', '=', 'master_jenis_hak.id')
            ->groupBy('master_bidang.Entitas', 'master_jenis_hak.jenis_hak')
            ->get()
            ->groupBy('Entitas')
            ->map(function ($items, $entitas) {
                $jenisHakData = [];
                foreach ($items as $item) {
                    $jenisHak = $item->jenis_hak ?? 'Tidak Diketahui';
                    $jenisHakData[$jenisHak] = $item->total;
                }

                return [
                    'entitas' => $entitas,
                    'data' => $jenisHakData,
                    'total' => $items->sum('total')
                ];
            })->values();

        // Data untuk chart jenis permohonan berdasarkan entitas
        // Karena Jenis_Permohonan adalah integer yang merujuk ke master_jenis_permohonan.id
        $jenisPermohonanByEntitas = ProsesDokumen::select(
            'master_bidang.Entitas',
            'master_jenis_permohonan.jenis_permohonan',
            DB::raw('count(*) as total')
        )
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->leftJoin('master_jenis_permohonan', 'master_bidang.Jenis_Permohonan', '=', 'master_jenis_permohonan.id')
            ->groupBy('master_bidang.Entitas', 'master_jenis_permohonan.jenis_permohonan')
            ->get()
            ->groupBy('Entitas')
            ->map(function ($items, $entitas) {
                $jenisPermohonanData = [];
                foreach ($items as $item) {
                    $jenisPermohonan = $item->jenis_permohonan ?? 'Tidak Diketahui';
                    $jenisPermohonanData[$jenisPermohonan] = $item->total;
                }

                return [
                    'entitas' => $entitas,
                    'data' => $jenisPermohonanData,
                    'total' => $items->sum('total')
                ];
            })->values();

        // Hitung dokumen berdasarkan status clear dan non clear
        // Clear: posisi_id dalam (2,3,4) dengan keterangan kosong ATAU null ATAU "Tidak ada isu Teknis"
        $clearCount = ProsesDokumen::whereIn('posisi_id', [2, 3, 4])
            ->where(function ($q) {
                $q->where('keterangan', '')
                    ->orWhereNull('keterangan')
                    ->orWhere('keterangan', 'Tidak ada isu Teknis');
            })
            ->count();

        // Data untuk chart non clear berdasarkan entitas
        $nonClearByEntitas = ProsesDokumen::select(
            'master_bidang.Entitas',
            DB::raw('count(*) as total')
        )
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->whereIn('proses_dokumen.posisi_id', [2, 3, 4])
            ->where('proses_dokumen.keterangan', '!=', '')
            ->whereNotNull('proses_dokumen.keterangan')
            ->where('proses_dokumen.keterangan', '!=', 'Tidak ada isu Teknis')
            ->groupBy('master_bidang.Entitas')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->Entitas,
                    'value' => $item->total
                ];
            });

        // Non Clear: posisi_id dalam (2,3,4) dengan keterangan tidak kosong dan tidak null dan bukan "Tidak ada isu Teknis"
        $nonClearCount = ProsesDokumen::whereIn('posisi_id', [2, 3, 4])
            ->where('keterangan', '!=', '')
            ->whereNotNull('keterangan')
            ->where('keterangan', '!=', 'Tidak ada isu Teknis')
            ->count();

        return view('dashboard.index', compact(
            'totalDokumen',
            'posisiData',
            'dokumenByEntitas',
            'jenisHakByEntitas',
            'jenisPermohonanByEntitas',
            'clearCount',
            'nonClearCount',
            'nonClearByEntitas'
        ));
    }

    public function detail(Request $request)
    {
        $posisiId = $request->get('posisi_id');
        $entitas = $request->get('entitas');
        $jenisHak = $request->get('jenis_hak');
        $jenisPermohonan = $request->get('jenis_permohonan');
        $status = $request->get('status');

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
            'master_jenis_permohonan.jenis_permohonan'
        )
            ->join('master_bidang', 'proses_dokumen.bidang_id', '=', 'master_bidang.id')
            ->join('master_posisi', 'proses_dokumen.posisi_id', '=', 'master_posisi.id')
            ->leftJoin('master_jenis_hak', 'master_bidang.Jenis_Hak', '=', 'master_jenis_hak.id')
            ->leftJoin('master_jenis_permohonan', 'master_bidang.Jenis_Permohonan', '=', 'master_jenis_permohonan.id');

        // Filter berdasarkan parameter
        if ($posisiId) {
            $query->where('proses_dokumen.posisi_id', $posisiId);
        }

        if ($entitas) {
            $query->where('master_bidang.Entitas', $entitas);
        }

        if ($jenisHak) {
            $query->where('master_jenis_hak.jenis_hak', $jenisHak);
        }

        if ($jenisPermohonan) {
            $query->where('master_jenis_permohonan.jenis_permohonan', $jenisPermohonan);
        }

        // Filter berdasarkan status
        if ($status) {
            if ($status === 'clear') {
                // Clear: posisi_id dalam (2,3,4) dengan keterangan kosong ATAU null ATAU "Tidak ada isu Teknis"
                $query->whereIn('proses_dokumen.posisi_id', [2, 3, 4])
                    ->where(function ($q) {
                        $q->where('proses_dokumen.keterangan', '')
                            ->orWhereNull('proses_dokumen.keterangan')
                            ->orWhere('proses_dokumen.keterangan', 'Tidak ada isu Teknis');
                    });
            } elseif ($status === 'non_clear') {
                // Non Clear: posisi_id dalam (2,3,4) dengan keterangan tidak kosong dan tidak null dan bukan "Tidak ada isu Teknis"
                $query->whereIn('proses_dokumen.posisi_id', [2, 3, 4])
                    ->where('proses_dokumen.keterangan', '!=', '')
                    ->whereNotNull('proses_dokumen.keterangan')
                    ->where('proses_dokumen.keterangan', '!=', 'Tidak ada isu Teknis');
            }
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
        if ($jenisHak) {
            $filterInfo['jenis_hak'] = $jenisHak;
        }
        if ($jenisPermohonan) {
            $filterInfo['jenis_permohonan'] = $jenisPermohonan;
        }
        if ($status) {
            $filterInfo['status'] = $status === 'clear' ? 'Clear' : 'Non Clear';
        }

        return view('dashboard.detail', compact('dokumenDetail', 'filterInfo'));
    }
}
