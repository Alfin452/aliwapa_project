<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // Pastikan buat controller ini nanti
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- GROUP 1: BISA DIAKSES ADMIN & KARYAWAN ---
Route::middleware('auth')->group(function () {

    // Fitur Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books/trash', [App\Http\Controllers\BookController::class, 'trash'])->name('books.trash');
    Route::put('/books/{id}/restore', [App\Http\Controllers\BookController::class, 'restore'])->name('books.restore');
    Route::delete('/books/{id}/force-delete', [App\Http\Controllers\BookController::class, 'forceDelete'])->name('books.force-delete');

    // Route Import Excel
    Route::post('/books/import', [App\Http\Controllers\BookController::class, 'importExcel'])->name('books.import');
    Route::get('/books/template', [App\Http\Controllers\BookController::class, 'downloadTemplate'])->name('books.template');

    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('shelves', App\Http\Controllers\ShelfController::class)->except(['create', 'edit', 'show']);
    
    Route::resource('books', BookController::class);
});

// --- GROUP 2: KHUSUS ADMIN SAJA ---
Route::middleware(['auth', 'admin'])->group(function () {

    // Fitur Manajemen User (Tambah/Edit/Hapus Karyawan)
    // Karyawan biasa TIDAK BISA akses URL ini (akan error 403)
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';
