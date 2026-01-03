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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // Relasi: Siapa yang input? Dimana raknya? Apa kategorinya?
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('shelf_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');

            // Data Inti sesuai Excel
            $table->string('nomor_induk_buku')->unique(); // Tidak boleh kembar
            $table->string('nomor_barcode')->unique();    // Tidak boleh kembar
            $table->string('judul');
            $table->string('pengarang');
            $table->string('tempat_terbit');
            $table->string('penerbit');
            $table->year('tahun_terbit'); // Tipe data tahun

            $table->integer('qty_inventaris');
            $table->integer('qty_opac');
            $table->integer('qty_rak');

            $table->text('keterangan')->nullable(); // Boleh dikosongkan

            $table->softDeletes(); // Fitur tong sampah aman
            $table->timestamps(); // Created_at (Tanggal Input otomatis)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
