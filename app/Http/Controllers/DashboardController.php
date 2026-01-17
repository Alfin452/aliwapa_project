<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Shelf;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. KARTU STATISTIK UTAMA
        $totalTitles = Book::count();
        $totalCopies = Book::sum('jml_inventaris');
        $totalCategories = Category::count();
        $totalUsers = User::count();

        // Buku baru bulan ini
        $newBooksThisMonth = Book::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        // 2. DATA UNTUK GRAFIK (CHART) [DIPERBAIKI]
        // Hanya ambil kategori yang MEMILIKI buku (jumlah > 0)
        $chartCategories = Category::withCount('books')
            ->having('books_count', '>', 0) // <--- PENTING: Filter kategori kosong
            ->orderByDesc('books_count')
            ->take(5)
            ->get();

        // Siapkan array untuk Chart.js
        $chartLabels = $chartCategories->pluck('nama_kategori');
        $chartValues = $chartCategories->pluck('books_count');

        // 3. TABEL BUKU TERBARU
        $recentBooks = Book::with(['category', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalTitles',
            'totalCopies',
            'totalCategories',
            'totalUsers',
            'newBooksThisMonth',
            'recentBooks',
            'chartLabels',
            'chartValues'
        ));
    }
}
