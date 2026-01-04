<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'role' => 'admin', // PENTING: Role Admin
            'password' => Hash::make('password'),
        ]);

        // 2. Buat Akun KARYAWAN A
        User::create([
            'name' => 'Karyawan A',
            'email' => 'karyawan.a@test.com',
            'role' => 'karyawan',
            'password' => Hash::make('password'),
        ]);

        // 3. Buat Akun KARYAWAN B
        User::create([
            'name' => 'Karyawan B',
            'email' => 'karyawan.b@test.com',
            'role' => 'karyawan',
            'password' => Hash::make('password'),
        ]);
    }
}
