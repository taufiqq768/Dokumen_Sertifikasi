<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterJenisHak;

class MasterJenisHakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisHakData = [
            ['jenis_hak' => 'HGU'],
            ['jenis_hak' => 'HGB'],
            ['jenis_hak' => 'HP'],
            ['jenis_hak' => 'HPL']
        ];

        foreach ($jenisHakData as $data) {
            MasterJenisHak::create($data);
        }
    }
}
