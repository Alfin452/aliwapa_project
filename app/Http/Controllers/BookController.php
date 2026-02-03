<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes; // <--- 1. Import ini
class BookController extends Controller
{
    use SoftDeletes; // <--- 2. Pasang di sini
    /**
     * Menampilkan daftar semua buku (Gabungan data A, B, Admin)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $books = Book::with(['category', 'shelf', 'user'])
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('pengarang', 'like', "%{$search}%")
                    ->orWhere('no_induk_buku', 'like', "%{$search}%")
                    ->orWhere('no_barcode', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // PERBAIKAN: Jika request dari AJAX, kirim hanya partial view-nya saja
        if ($request->ajax()) {
            return view('books.partials.table-rows', compact('books'))->render();
        }

        return view('books.index', compact('books'));
    }

    public function create()
    {
        // Ambil data kategori dan rak untuk dropdown
        $categories = \App\Models\Category::all();
        $shelves = \App\Models\Shelf::all();

        // Buat nomor induk otomatis (opsional, sebagai saran default)
        // Format: BUKU-TAHUN-RANDOM -> BUKU-2024-001
        $nextId = \App\Models\Book::max('id') + 1;
        $suggestedNoInduk = 'IND-' . date('Y') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('books.create', compact('categories', 'shelves', 'suggestedNoInduk'));
    }

    /**
     * Menyimpan data buku ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi Dasar
        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'pengarang'      => 'required|string|max:255',
            'no_induk_buku'  => 'required|string',
            'penerbit'       => 'nullable|string|max:255',
            'tempat_terbit'  => 'nullable|string|max:255', // Tambahkan ini
            'tahun_terbit'   => 'nullable|integer',
            'keterangan'     => 'nullable|string',         // Tambahkan ini
            'category_id'    => 'nullable|exists:categories,id',
            'shelf_id'       => 'nullable|exists:shelves,id',
            'no_barcode'     => 'nullable|string',
            'cover'          => 'nullable|image|max:2048',
            // Tambahkan validasi stok agar bisa diproses
            'jml_inventaris' => 'required|integer|min:0',
            'jml_rak'        => 'required|integer|min:0',
            'jml_opac'       => 'required|integer|min:0',
        ]);

        // 2. Upload Cover
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        // 3. Pecah String jadi Array
        $induk_list = explode(',', $request->no_induk_buku);
        $barcode_list = $request->no_barcode ? explode(',', $request->no_barcode) : [];

        // 4. Looping Simpan
        foreach ($induk_list as $index => $induk) {
            Book::create([
                'judul'          => $request->judul,
                'pengarang'      => $request->pengarang,
                'penerbit'       => $request->penerbit,
                'tempat_terbit'  => $request->tempat_terbit, // Simpan Kota
                'tahun_terbit'   => $request->tahun_terbit,
                'keterangan'     => $request->keterangan,    // Simpan Keterangan
                'no_induk_buku'  => trim($induk),
                'no_barcode'     => isset($barcode_list[$index]) ? trim($barcode_list[$index]) : null,

                // PERBAIKAN: Gunakan nilai dari input form, bukan angka 1
                'jml_inventaris' => $request->jml_inventaris,
                'jml_rak'        => $request->jml_rak,
                'jml_opac'       => $request->jml_opac,

                'category_id'    => $request->category_id,
                'shelf_id'       => $request->shelf_id,
                'cover'          => $coverPath,
                'user_id'        => $request->user()->id,
            ]);
        }

        return redirect()->route('books.index')->with('success', count($induk_list) . ' Buku berhasil ditambahkan!');
    }
    /**
     * Tampilkan form edit buku
     */
    public function edit(Book $book)
    {
        // 1. Ambil user yang login pakai helper request() biar editor tidak bingung
        $user = request()->user();

        // 2. Cek logic Hak Akses
        // "Jika user kosong, ATAU (Role bukan admin DAN ID user beda dengan pemilik buku)"
        if (! $user || ($user->role !== 'admin' && $user->id !== $book->user_id)) {
            abort(403, 'Anda tidak berhak mengedit data ini.');
        }

        $categories = \App\Models\Category::all();
        $shelves = \App\Models\Shelf::all();

        return view('books.edit', compact('book', 'categories', 'shelves'));
    }

    /**
     * Update data buku ke database
     */
    public function update(Request $request, Book $book)
    {
        // Cek Hak Akses (Admin atau Pemilik Data)
        $user = $request->user();
        if (! $user || ($user->role !== 'admin' && $user->id !== $book->user_id)) {
            abort(403, 'Anda tidak berhak mengedit data ini.');
        }

        // 1. Definisikan Aturan Validasi (Perhatikan Unique Rule untuk Update)
        $rules = [
            'judul'         => 'required|string|max:255',
            'pengarang'     => 'required|string|max:255',
            // Ignore ID buku ini saat cek unique (biar gak error kalau nomor induknya gak diganti)
            'no_induk_buku' => 'required|unique:books,no_induk_buku,' . $book->id,

            'jml_inventaris' => 'required|integer|min:0',
            'jml_rak'       => 'required|integer|min:0',
            'jml_opac'      => 'required|integer|min:0',

            'penerbit'      => 'nullable|string|max:255',
            'tempat_terbit' => 'nullable|string|max:255',
            'tahun_terbit'  => 'nullable|integer|min:1901|max:' . (date('Y') + 1),
            'keterangan'    => 'nullable|string',

            'category_id'   => 'nullable|exists:categories,id',
            'shelf_id'      => 'nullable|exists:shelves,id',
            // Ignore ID buku ini juga untuk barcode
            'no_barcode'    => 'nullable|unique:books,no_barcode,' . $book->id,

            'cover'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        // 2. Pesan Error (Sama dengan store)
        $messages = [
            'required' => ':attribute wajib diisi.',
            'unique'   => ':attribute sudah digunakan buku lain.',
            'integer'  => ':attribute harus berupa angka.',
            'exists'   => 'Pilihan :attribute tidak valid.',
            // ... (pesan lain default Laravel sudah cukup jelas, atau copy dari store)
        ];

        // 3. Eksekusi Validasi
        $validated = $request->validate($rules, $messages);

        // 4. Handle Upload Gambar Baru (Hapus lama jika ada)
        if ($request->hasFile('cover')) {
            // Hapus cover lama dari storage
            if ($book->cover && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->cover)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover);
            }
            // Simpan cover baru
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // 5. Update Data
        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Hapus buku
     */
    public function destroy(Book $book)
    {
        // 1. Ambil user
        $user = request()->user();

        // 2. Cek Hak Akses
        if (! $user || ($user->role !== 'admin' && $user->id !== $book->user_id)) {
            abort(403, 'Dilarang menghapus data orang lain.');
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    // --- FITUR SAMPAH (TRASH) ---

    /**
     * Tampilkan halaman tong sampah
     */
    public function trash()
    {
        // Ambil HANYA data yang sudah dihapus
        $books = Book::onlyTrashed()->latest()->paginate(10);
        return view('books.trash', compact('books'));
    }

    /**
     * Pulihkan data (Restore)
     */
    public function restore($id)
    {
        // Cari data di sampah berdasarkan ID
        $book = Book::onlyTrashed()->findOrFail($id);

        // Pulihkan
        $book->restore();

        return redirect()->route('books.trash')->with('success', 'Data buku berhasil dipulihkan (Restore).');
    }

    /**
     * Hapus Permanen (Force Delete)
     */
    public function forceDelete($id)
    {
        // Cari data di sampah
        $book = Book::onlyTrashed()->findOrFail($id);

        // Hapus file cover fisik dari storage jika ada (Biar server gak penuh)
        if ($book->cover && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->cover)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover);
        }

        // Hapus Permanen dari Database
        $book->forceDelete();

        return redirect()->route('books.trash')->with('success', 'Buku telah dihapus permanen.');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\BookImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data buku berhasil diimpor!');
    }
    public function downloadTemplate()
    {
        // Menggunakan Class Export terpisah agar lebih rapi & proper
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\BookTemplateExport, 'template_buku_rapi.xlsx');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        // Hapus data berdasarkan array ID yang dikirim
        Book::whereIn('id', $request->ids)->delete();

        return redirect()->back()->with('success', count($request->ids) . ' Buku berhasil dipindahkan ke sampah.');
    }

    /**
     * Restore Banyak
     */
    public function bulkRestore(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        Book::onlyTrashed()->whereIn('id', $request->ids)->restore();

        return redirect()->back()->with('success', count($request->ids) . ' Buku berhasil dipulihkan.');
    }

    /**
     * Force Delete Banyak
     */
    public function bulkForceDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);

        // Ambil data dulu untuk menghapus gambar covernya
        $books = Book::onlyTrashed()->whereIn('id', $request->ids)->get();

        foreach ($books as $book) {
            if ($book->cover && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->cover)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover);
            }
            $book->forceDelete();
        }

        return redirect()->back()->with('success', count($request->ids) . ' Buku telah dihapus permanen.');
    }
}
