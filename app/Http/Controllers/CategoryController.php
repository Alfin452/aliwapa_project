<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar kategori
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::when($search, function ($query, $search) {
            return $query->where('nama_kategori', 'like', "%{$search}%")
                ->orWhere('kode_ddc', 'like', "%{$search}%");
        })
            ->orderBy('kode_ddc', 'asc') // Urutkan berdasarkan Kode DDC (000, 100, dst)
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    /**
     * Tampilkan form tambah
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ddc'      => 'required|string|max:10|unique:categories,kode_ddc',
            'nama_kategori' => 'required|string|max:255',
        ], [
            'required' => ':attribute wajib diisi.',
            'unique'   => 'Kode DDC ini sudah ada.',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'kode_ddc'      => 'required|string|max:10|unique:categories,kode_ddc,' . $category->id,
            'nama_kategori' => 'required|string|max:255',
        ], [
            'required' => ':attribute wajib diisi.',
            'unique'   => 'Kode DDC ini sudah digunakan kategori lain.',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Category $category)
    {
        // PENTING: Cek dulu apakah kategori ini sedang dipakai oleh buku?
        if ($category->books()->count() > 0) {
            return back()->with('error', 'Gagal hapus! Kategori ini masih dipakai oleh ' . $category->books()->count() . ' buku.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
