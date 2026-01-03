<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Shelf;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Tampilkan daftar buku (Nanti kita kerjakan di Tahap 5)
     */
    public function index()
    {
        // Ambil semua data buku, urutkan dari yang terbaru
        // with('user') artinya sekalian ambil data nama penginputnya
        $books = Book::with(['user', 'shelf', 'category'])->latest()->get();
        return view('books.index', compact('books'));
    }

    /**
     * Tampilkan FORMULIR input buku
     */
    public function create()
    {
        // Kita butuh data Rak dan Kategori buat isian Dropdown
        $shelves = Shelf::all();
        $categories = Category::all();

        return view('books.create', compact('shelves', 'categories'));
    }

    /**
     * Proses SIMPAN data ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (Cek apakah data sesuai aturan)
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'nomor_induk_buku' => 'required|unique:books,nomor_induk_buku', // Gak boleh kembar
            'nomor_barcode' => 'required|unique:books,nomor_barcode',       // Gak boleh kembar
            'pengarang' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'tempat_terbit' => 'required|string',
            'qty_inventaris' => 'required|integer|min:0',
            'qty_opac' => 'required|integer|min:0',
            'qty_rak' => 'required|integer|min:0',
            'shelf_id' => 'required|exists:shelves,id',      // Wajib pilih rak yang valid
            'category_id' => 'required|exists:categories,id', // Wajib pilih kategori
            'keterangan' => 'nullable|string',
        ]);

        // 2. Masukkan ID Penginput Otomatis
        // Kita ambil ID user yang sedang login saat ini
        $validated['user_id'] = Auth::id();

        // 3. Simpan ke Database
        Book::create($validated);

        // 4. Balik ke halaman daftar dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }
}
