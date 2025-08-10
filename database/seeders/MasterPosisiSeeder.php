<?php

namespace Database\Seeders;

use App\Models\MasterPosisi;
use Illuminate\Database\Seeder;

class MasterPosisiSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $posisiData = [
            ['posisi' => 'Belum Telaah'],
            ['posisi' => 'Proses Telaah'],
            ['posisi' => 'Klarifikasi ke Kanwil'],
            ['posisi' => 'Sirkular Persetujuan'],
            ['posisi' => 'Terbit SK']
        ];

        foreach ($posisiData as $posisi) {
            MasterPosisi::create($posisi);
        }
    }
}
