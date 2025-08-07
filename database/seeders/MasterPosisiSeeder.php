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
            ['posisi' => 'berkas_baru_masuk'],
            ['posisi' => 'permintaan penjelasan dokumen'],
            ['posisi' => 'penelaahan Berkas'],
            ['posisi' => 'sirkular persetujuan']
        ];

        foreach ($posisiData as $posisi) {
            MasterPosisi::create($posisi);
        }
    }
}
