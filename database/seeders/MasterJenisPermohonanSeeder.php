<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterJenisPermohonan;

class MasterJenisPermohonanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisPermohonanData = [
            ['jenis_permohonan' => 'Permohonan Baru'],
            ['jenis_permohonan' => 'Pendaftaran Pertama Kali'],
            ['jenis_permohonan' => 'Perpanjangan/Pembaharuan'],
        ];

        foreach ($jenisPermohonanData as $data) {
            MasterJenisPermohonan::create($data);
        }
    }
}
