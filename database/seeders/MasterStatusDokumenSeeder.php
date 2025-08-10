<?php

namespace Database\Seeders;

use App\Models\MasterStatusDokumen;
use Illuminate\Database\Seeder;

class MasterStatusDokumenSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $status_dokumenData = [
            ['status_dokumen' => 'Bidang Perlu Tindak Lanjut (Uncler)'],
            ['status_dokumen' => 'Bidang Maju Proses Sirkular Persetujuan (Clear)'],
            ['status_dokumen' => 'Dokumen Baru Terima dan Belum Telaah'],
        ];

        foreach ($status_dokumenData as $status_dokumen) {
            MasterStatusDokumen::create($status_dokumen);
        }
    }
}
