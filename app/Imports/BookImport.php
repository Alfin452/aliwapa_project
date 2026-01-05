<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToModel, WithHeadingRow
{
    // Variabel untuk mencatat ID yang sudah diproses dalam file ini (mencegah duplikat internal)
    private $processed_induk = [];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // 1. Cek Data Utama (Nomor Induk Wajib Ada)
        // Kita trim dan cek kosong
        if (!isset($row['nomor_induk_buku']) || empty(trim($row['nomor_induk_buku']))) {
            return null;
        }

        // 2. Pecah Data (Explode) untuk Bulk Insert
        $list_induk   = explode(',', $row['nomor_induk_buku']);
        $list_barcode = isset($row['nomor_barcode']) ? explode(',', $row['nomor_barcode']) : [];

        // 3. Ambil Data Stok & Mapping Kolom Excel
        // Menggunakan nama header sesuai file Excel kamu
        $excel_inv  = intval($row['jumlah_eksmplar_di_inventaris_buku'] ?? $row['jumlah_inventaris'] ?? 1);
        $excel_rak  = intval($row['jumlah_eksmplar_di_rak'] ?? $row['jumlah_rak'] ?? 1);
        $excel_opac = intval($row['jumlah_eksmplar_di_opac'] ?? $row['jumlah_opac'] ?? 1);

        // Logika: Jika input banyak ID (dipisah koma), paksa stok jadi 1.
        $is_bulk = count($list_induk) > 1;

        // 4. Cari Kategori & Rak (Query Database)
        $category = null;
        if (!empty($row['kode_kategori'])) {
            $category = Category::where('kode_ddc', $row['kode_kategori'])->first();
        }

        $shelf = null;
        if (!empty($row['lokasi_rak'])) {
            $shelf = Shelf::where('nama_rak', $row['lokasi_rak'])->first();
        }

        $books = [];

        // 5. Looping Simpan Setiap Buku
        foreach ($list_induk as $index => $no_induk) {
            $clean_induk = trim($no_induk);

            // Skip jika kosong
            if (empty($clean_induk)) continue;

            // --- VALIDASI DUPLIKAT (PENTING) ---

            // A. Cek apakah sudah diproses di baris sebelumnya dalam file yang sama?
            if (in_array($clean_induk, $this->processed_induk)) {
                continue; // Skip agar tidak error duplikat entry
            }

            // B. Cek apakah sudah ada di Database (BAIK YANG AKTIF MAUPUN DI SAMPAH)
            // withTrashed() akan mengecek buku yang sudah dihapus juga.
            if (Book::withTrashed()->where('no_induk_buku', $clean_induk)->exists()) {
                continue; // Skip buku ini, lanjut ke buku berikutnya
            }

            // Tandai nomor ini sudah diproses
            $this->processed_induk[] = $clean_induk;
            // -----------------------------------

            $clean_barcode = isset($list_barcode[$index]) ? trim($list_barcode[$index]) : null;

            // Masukkan ke antrian simpan
            $books[] = new Book([
                'no_induk_buku' => $clean_induk,
                'no_barcode'    => $clean_barcode,
                'judul'         => $row['judul'] ?? 'Tanpa Judul',
                'pengarang'     => $row['pengarang'] ?? '-',
                'tempat_terbit' => $row['tempat_terbit'] ?? null,
                'penerbit'      => $row['penerbit'] ?? null,
                'tahun_terbit'  => $row['tahun_terbit'] ?? null,

                // Set Stok
                'jml_inventaris' => $is_bulk ? 1 : $excel_inv,
                'jml_rak'       => $is_bulk ? 1 : $excel_rak,
                'jml_opac'      => $is_bulk ? 1 : $excel_opac,

                'keterangan'    => $row['keterangan'] ?? null,
                'category_id'   => $category ? $category->id : null,
                'shelf_id'      => $shelf ? $shelf->id : null,
                'user_id'       => Auth::id(),
            ]);
        }

        return $books;
    }
}
