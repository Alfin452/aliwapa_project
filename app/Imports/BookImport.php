<?php

namespace App\Imports;

use App\Models\Book;
use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // Agar bisa baca header baris 1

class BookImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // 1. Cek Data Utama
        if (!isset($row['nomor_induk_buku']) || $row['nomor_induk_buku'] == null) {
            return null;
        }

        // 2. Logic Pecah Data (Explode)
        // Memisahkan string berdasarkan koma (,)
        $list_induk   = explode(',', $row['nomor_induk_buku']);
        $list_barcode = isset($row['nomor_barcode']) ? explode(',', $row['nomor_barcode']) : [];

        // Cari Kategori & Rak (Sama seperti sebelumnya)
        $category = null;
        if (isset($row['kode_kategori']) && $row['kode_kategori']) {
            $category = Category::where('kode_ddc', $row['kode_kategori'])->first();
        }

        $shelf = null;
        if (isset($row['lokasi_rak']) && $row['lokasi_rak']) {
            $shelf = Shelf::where('nama_rak', $row['lokasi_rak'])->first();
        }

        // Array penampung buku-buku yang akan dibuat
        $books = [];

        // 3. LOOPING: Buat buku untuk setiap Nomor Induk
        foreach ($list_induk as $index => $no_induk) {

            // Bersihkan spasi (trim) misal: " B002 " jadi "B002"
            $clean_induk = trim($no_induk);

            // Ambil barcode sesuai urutan (index), kalau gak ada isi null
            $clean_barcode = isset($list_barcode[$index]) ? trim($list_barcode[$index]) : null;

            // Masukkan ke antrian simpan
            $books[] = new Book([
                // Data Unik per Buku
                'no_induk_buku' => $clean_induk,
                'no_barcode'    => $clean_barcode,

                // Data Judul (SAMA SEMUA)
                'judul'         => $row['judul'] ?? 'Tanpa Judul',
                'pengarang'     => $row['pengarang'] ?? '-',
                'tempat_terbit' => $row['tempat_terbit'] ?? null,
                'penerbit'      => $row['penerbit'] ?? null,
                'tahun_terbit'  => $row['tahun_terbit'] ?? null,

                // PENTING: Karena dipecah, stok per baris database adalah 1
                'jml_inventaris' => 1,
                'jml_rak'       => 1, // Asumsi masuk rak semua
                'jml_opac'      => 1, // Asumsi masuk opac semua

                'keterangan'    => $row['keterangan'] ?? null,
                'category_id'   => $category ? $category->id : null,
                'shelf_id'      => $shelf ? $shelf->id : null,
                'user_id'       => Auth::id(),
            ]);
        }

        // Kembalikan banyak buku sekaligus
        return $books;
    }
}
