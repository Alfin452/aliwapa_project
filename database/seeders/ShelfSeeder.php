<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShelfSeeder extends Seeder
{
    public function run(): void
    {
        $shelves = [
            ['nama_rak' => 'Rak A - Umum', 'lokasi' => 'Lantai 1'],
            ['nama_rak' => 'Rak B - Agama', 'lokasi' => 'Lantai 1'],
            ['nama_rak' => 'Rak C - Sosial', 'lokasi' => 'Lantai 2'],
            ['nama_rak' => 'Rak D - Sains', 'lokasi' => 'Lantai 2'],
            ['nama_rak' => 'Gudang', 'lokasi' => 'Belakang'],
        ];

        DB::table('shelves')->insert($shelves);
    }
}
