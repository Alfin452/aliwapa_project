<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shelf;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DataAwalSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bikin Akun Admin (Supaya gak capek register manual)
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Isi Data Rak
        Shelf::create(['nama_rak' => 'Rak A-01 (Fiksi)', 'lokasi' => 'Lantai 1 - Lorong Kiri']);
        Shelf::create(['nama_rak' => 'Rak B-02 (Sains)', 'lokasi' => 'Lantai 1 - Lorong Kanan']);
        Shelf::create(['nama_rak' => 'Lemari Kaca (Arsip)', 'lokasi' => 'Lantai 2 - Ruang Kepala']);

        // 3. Isi Data Kategori
        Category::create(['nama_kategori' => 'Buku Pelajaran']);
        Category::create(['nama_kategori' => 'Novel & Fiksi']);
        Category::create(['nama_kategori' => 'Jurnal Ilmiah']);
        Category::create(['nama_kategori' => 'Majalah & Koran']);
    }
}
