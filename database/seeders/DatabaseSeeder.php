<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder yang baru dibuat
        $this->call([
            CategorySeeder::class,
            ShelfSeeder::class,
            UserSeeder::class,     // <-- User Login (Admin & Karyawan)
        ]);

        // User::factory(10)->create(); // (Bawaan Laravel, bisa di-comment atau pakai)
    }
}
