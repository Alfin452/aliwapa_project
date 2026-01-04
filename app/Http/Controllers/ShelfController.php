<?php

namespace App\Http\Controllers;

use App\Models\Shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    /**
     * Tampilkan daftar rak
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $shelves = Shelf::when($search, function ($query, $search) {
            return $query->where('nama_rak', 'like', "%{$search}%")
                ->orWhere('lokasi', 'like', "%{$search}%");
        })
            ->orderBy('nama_rak', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('shelves.index', compact('shelves'));
    }

    /**
     * Simpan rak baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_rak' => 'required|string|max:255|unique:shelves,nama_rak',
            'lokasi'   => 'nullable|string|max:255', // Opsional, misal: "Lantai 2"
        ], [
            'required' => ':attribute wajib diisi.',
            'unique'   => 'Nama rak ini sudah ada.',
        ]);

        Shelf::create($validated);

        return redirect()->route('shelves.index')->with('success', 'Rak baru berhasil ditambahkan!');
    }

    /**
     * Update data rak
     */
    public function update(Request $request, Shelf $shelf)
    {
        $validated = $request->validate([
            'nama_rak' => 'required|string|max:255|unique:shelves,nama_rak,' . $shelf->id,
            'lokasi'   => 'nullable|string|max:255',
        ], [
            'required' => ':attribute wajib diisi.',
            'unique'   => 'Nama rak sudah digunakan.',
        ]);

        $shelf->update($validated);

        return redirect()->route('shelves.index')->with('success', 'Data rak berhasil diperbarui!');
    }

    /**
     * Hapus rak
     */
    public function destroy(Shelf $shelf)
    {
        // Proteksi: Jangan hapus jika ada buku di rak ini
        if ($shelf->books()->count() > 0) {
            return back()->with('error', 'Gagal hapus! Rak ini masih menyimpan ' . $shelf->books()->count() . ' buku.');
        }

        $shelf->delete();

        return redirect()->route('shelves.index')->with('success', 'Rak berhasil dihapus.');
    }
}
