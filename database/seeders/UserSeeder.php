<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user admin default jika belum ada
        User::firstOrCreate(
            ['email' => 'admin@dokumen.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
            ]
        );

        // Buat user demo jika belum ada
        User::firstOrCreate(
            ['email' => 'demo@dokumen.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('demo123'),
            ]
        );

        // Buat user test jika belum ada (untuk kompatibilitas)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );
    }
}
