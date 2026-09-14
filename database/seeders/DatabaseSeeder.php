<?php

namespace Database\Seeders;

use App\Models\AreaParkir;
use App\Models\Tarif;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'nama_lengkap' => 'Admin Utama',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status_aktif' => 1,
            ],
            [
                'nama_lengkap' => 'Budi Santoso',
                'username' => 'petugas',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
                'status_aktif' => 1,
            ],
            [
                'nama_lengkap' => 'Siti Rahayu',
                'username' => 'owner',
                'password' => Hash::make('owner123'),
                'role' => 'owner',
                'status_aktif' => 1,
            ],
        ]);

        Tarif::insert([
            ['jenis_kendaraan' => 'motor', 'tarif_per_jam' => 2000],
            ['jenis_kendaraan' => 'mobil', 'tarif_per_jam' => 5000],
            ['jenis_kendaraan' => 'lainnya', 'tarif_per_jam' => 3000],
        ]);

        AreaParkir::insert([
            ['nama_area' => 'Area A - Depan', 'kapasitas' => 40, 'terisi' => 0],
            ['nama_area' => 'Area B - Belakang', 'kapasitas' => 25, 'terisi' => 0],
        ]);
    }
}
