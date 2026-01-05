<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * 1. LAPORAN BUKU INDUK (Semua Koleksi Aktif)
     */
    public function bukuInduk(Request $request)
    {
        $books = Book::with(['category', 'shelf', 'user'])
            ->orderBy('no_induk_buku', 'asc')
            ->get(); // Ambil semua data (hati-hati jika ribuan, nanti bisa pakai chunk/pagination)

        return view('reports.buku_induk', compact('books'));
    }

    /**
     * 2. LAPORAN PENGADAAN (Berdasarkan Tanggal Input)
     */
    public function pengadaan(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-01')); // Default tgl 1 bulan ini
        $endDate = $request->input('end_date', date('Y-m-d'));       // Default hari ini

        $books = Book::with(['category', 'shelf'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->latest()
            ->get();

        return view('reports.pengadaan', compact('books', 'startDate', 'endDate'));
    }

    /**
     * 3. LAPORAN REKAPITULASI KLASIFIKASI (Statistik DDC)
     */
    public function klasifikasi()
    {
        // Hitung jumlah buku per kategori
        $categories = Category::withCount('books')->get();

        // Hitung buku tanpa kategori
        $uncategorizedCount = Book::whereNull('category_id')->count();

        return view('reports.klasifikasi', compact('categories', 'uncategorizedCount'));
    }

    /**
     * 4. LAPORAN PENGHAPUSAN (Buku di Tong Sampah)
     */
    public function penghapusan()
    {
        // Ambil data sampah
        $deletedBooks = Book::onlyTrashed()
            ->with(['category'])
            ->orderBy('deleted_at', 'desc')
            ->get();

        return view('reports.penghapusan', compact('deletedBooks'));
    }

    /**
     * 5. LAPORAN STOCK OPNAME (Posisi Rak)
     */
    public function stockOpname()
    {
        // Urutkan berdasarkan Rak agar mudah dicek fisik
        $books = Book::with(['shelf'])
            ->orderBy('shelf_id', 'asc') // Null (Gudang) biasanya di paling atas/bawah
            ->orderBy('no_induk_buku', 'asc')
            ->get();

        return view('reports.stock_opname', compact('books'));
    }
}
