<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['kode_ddc' => '000', 'nama_kategori' => 'Karya Umum'],
            ['kode_ddc' => '100', 'nama_kategori' => 'Filsafat & Psikologi'],
            ['kode_ddc' => '200', 'nama_kategori' => 'Agama'],
            ['kode_ddc' => '300', 'nama_kategori' => 'Ilmu Sosial'],
            ['kode_ddc' => '400', 'nama_kategori' => 'Bahasa'],
            ['kode_ddc' => '500', 'nama_kategori' => 'Sains'],
            ['kode_ddc' => '600', 'nama_kategori' => 'Teknologi'],
            ['kode_ddc' => '700', 'nama_kategori' => 'Kesenian & Hiburan'],
            ['kode_ddc' => '800', 'nama_kategori' => 'Kesusastraan'],
            ['kode_ddc' => '900', 'nama_kategori' => 'Sejarah & Geografi'],
        ];

        DB::table('categories')->insert($categories);
    }
}
