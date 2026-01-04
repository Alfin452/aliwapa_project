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

            // Relasi User (Penginput)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // --- TAMBAHAN BARU: Relasi Kategori & Rak ---
            // Kita buat nullable dulu, jaga-jaga kalau data excelnya ada yang kosong
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('shelf_id')->nullable()->constrained()->nullOnDelete();

            // Data Buku (Sama seperti sebelumnya)
            $table->string('no_induk_buku')->unique();
            $table->string('no_barcode')->unique()->nullable();
            $table->string('judul');
            $table->string('pengarang');
            $table->string('tempat_terbit')->nullable();
            $table->string('penerbit')->nullable();
            $table->year('tahun_terbit')->nullable();

            $table->integer('jml_inventaris')->default(0);
            $table->integer('jml_opac')->default(0);
            $table->integer('jml_rak')->default(0); // Ini jumlah fisik buku di rak

            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
