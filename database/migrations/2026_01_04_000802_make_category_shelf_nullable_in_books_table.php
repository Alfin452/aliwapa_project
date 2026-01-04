<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Ubah kolom jadi nullable (boleh kosong)
            $table->foreignId('category_id')->nullable()->change();
            $table->foreignId('shelf_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Kembalikan jadi wajib (tidak boleh kosong)
            // Hati-hati: ini akan error jika ada data NULL saat rollback
            $table->foreignId('category_id')->nullable(false)->change();
            $table->foreignId('shelf_id')->nullable(false)->change();
        });
    }
};
