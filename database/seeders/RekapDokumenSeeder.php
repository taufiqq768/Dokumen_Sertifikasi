<?php

namespace Database\Seeders;

use App\Models\RekapDokumen;
use Illuminate\Database\Seeder;

class RekapDokumenSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $dokumenData = [
            // PALM
            [
                'No_Berkas' => 'DOC-PALM-001',
                'Lokasi' => 'PALM',
                'Posisi' => 'berkas_baru_masuk',
                'Status' => 'clear',
                'Tanggal_Informasi' => '2024-01-15',
                'Keterangan' => 'Sertifikat ISO 9001 PALM',
                'PIC' => 'Ahmad Rizki',
                'Note' => 'Dokumen lengkap dan sesuai standar'
            ],
            [
                'No_Berkas' => 'DOC-PALM-002',
                'Lokasi' => 'PALM',
                'Posisi' => 'penelaahan',
                'Status' => 'unclear',
                'Tanggal_Informasi' => '2024-01-16',
                'Keterangan' => 'Laporan Audit PALM',
                'PIC' => 'Siti Nurhaliza',
                'Note' => 'Perlu revisi pada bagian lampiran'
            ],
            [
                'No_Berkas' => 'DOC-PALM-003',
                'Lokasi' => 'PALM',
                'Posisi' => 'sirkular',
                'Status' => 'clear',
                'Tanggal_Informasi' => '2024-01-17',
                'Keterangan' => 'Sirkular Kebijakan PALM',
                'PIC' => 'Budi Santoso',
                'Note' => 'Sudah disebarkan ke semua divisi'
            ],
            [
                'No_Berkas' => 'DOC-PALM-004',
                'Lokasi' => 'PALM',
                'Posisi' => 'berkas_baru_masuk',
                'Status' => 'clear',
                'Tanggal_Informasi' => '2024-01-18',
                'Keterangan' => 'Dokumen Prosedur PALM',
                'PIC' => 'Dewi Lestari',
                'Note' => 'Dokumen baru dari divisi QA'
            ],
            [
                'No_Berkas' => 'DOC-PALM-005',
                'Lokasi' => 'PALM',
                'Posisi' => 'penelaahan',
                'Status' => 'clear',
                'Tanggal_Informasi' => '2024-01-19',
                'Keterangan' => 'Manual Kualitas PALM',
                'PIC' => 'Eko Prasetyo',
                'Note' => 'Sudah diverifikasi oleh tim QC'
            ],

            // SUPPCO
            [
                'No_Berkas' => 'DOC-SUPPCO-001',
                'Lokasi' => 'SUPPCO',
                'Posisi' => 'berkas_baru_masuk',
                'Status' => 'clear',
                'Tanggal_Informasi' => '2024-01-20',
                'Keterangan' => 'Sertifikat HACCP SUPPCO',
                'PIC' => 'Fitri Handayani',
                'Note' => 'Sertifikat baru dari badan sertifikasi'
            ],
            [
                'No_Berkas' => 'DOC-SUPPCO-002',
                'Lokasi' => 'SUPPCO',
                'Posisi' => 'penelaahan',
                'Status' => 'unclear',
                'Tanggal_Informasi' => '2024-01-21',
                'Keterangan' => 'Laporan Inspeksi SUPPCO',
                'PIC' => 'Gunawan Wijaya',
                'Note' => 'Ada beberapa temuan yang perlu ditindaklanjuti'
            ],
            [
                'No_Berkas' => 'DOC-SUPPCO-003',
                'Lokasi' => 'SUPPCO',
                'Posisi' => 'sirkular',
                'Status' => 'clear',
                'Tanggal_Informasi' => '2024-01-22',
                'Keterangan' => 'Sirkular Keamanan SUPPCO',
                'PIC' => 'Hendra Kusuma',
                'Note' => 'Sirkular keamanan pangan terbaru'
            ],
            [
                'No_Berkas' => 'DOC-SUPPCO-004',
                'Lokasi' => 'SUPPCO',
                'Posisi' => 'berkas_baru_masuk',
                'Status' => 'unclear',
                'Tanggal_Informasi' => '2024-01-23',
                'Keterangan' => 'Dokumen Traceability SUPPCO',
                'PIC' => 'Indira Sari',
                'Note' => 'Dokumen belum lengkap, menunggu data tambahan'
            ],

            // SGN
            [
                'No_Berkas' => 'DOC-SGN-001',
                'Lokasi' => 'SGN',
                'Posisi' => 'berkas_baru_masuk',
                'Status' => 'clear',
                'Tanggal_Informasi' => '2024-01-24',
                'Keterangan' => 'Sertifikat Halal SGN',
                'PIC' => 'Joko Widodo',
                'Note' => 'Sertifikat halal untuk produk baru'
            ],
            [
                'No_Berkas' => 'DOC-SGN-002',
                'Lokasi' => 'SGN',
                'Posisi' => 'penelaahan',
                'Status' => 'clear',
                'Tanggal_Informasi' => '2024-01-25',
                'Keterangan' => 'Laporan Validasi SGN',
                'PIC' => 'Kartika Dewi',
                'Note' => 'Laporan validasi proses produksi'
            ],
            [
                'No_Berkas' => 'DOC-SGN-003',
                'Lokasi' => 'SGN',
                'Posisi' => 'sirkular',
                'Status' => 'unclear',
                'Tanggal_Informasi' => '2024-01-26',
                'Keterangan' => 'Sirkular Regulasi SGN',
                'PIC' => 'Lukman Hakim',
                'Note' => 'Perlu konfirmasi dengan divisi legal'
            ],
            [
                'No_Berkas' => 'DOC-SGN-004',
                'Lokasi' => 'SGN',
                'Posisi' => 'berkas_baru_masuk',
                'Status' => 'clear',
                'Tanggal_Informasi' => '2024-01-27',
                'Keterangan' => 'Dokumen Kalibrasi SGN',
                'PIC' => 'Maya Sari',
                'Note' => 'Dokumen kalibrasi peralatan laboratorium'
            ],
            [
                'No_Berkas' => 'DOC-SGN-005',
                'Lokasi' => 'SGN',
                'Posisi' => 'penelaahan',
                'Status' => 'unclear',
                'Tanggal_Informasi' => '2024-01-28',
                'Keterangan' => 'Manual Operasi SGN',
                'PIC' => 'Nanda Pratama',
                'Note' => 'Manual perlu update sesuai prosedur terbaru'
            ]
        ];

        foreach ($dokumenData as $dokumen) {
            RekapDokumen::create($dokumen);
        }
    }
}