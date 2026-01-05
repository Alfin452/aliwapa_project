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
        // 1. Ambil Data Statistik (Jumlah Total)
        $totalBooks = Book::count(); // Total semua buku
        $totalCategories = Category::count();
        $totalShelves = Shelf::count();
        $totalUsers = User::count();

        // 2. Ambil 5 Buku Terbaru (Untuk tabel mini)
        $recentBooks = Book::with(['category', 'shelf', 'user'])
            ->latest()
            ->take(5)
            ->get();

        // 3. Kirim data ke View
        return view('dashboard', compact(
            'totalBooks',
            'totalCategories',
            'totalShelves',
            'totalUsers',
            'recentBooks'
        ));
    }
}
