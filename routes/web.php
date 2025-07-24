<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Halaman utama welcome, tanpa middleware
Route::get('/', function () {
    return view('welcome');
});

// Halaman home untuk user yang sudah login
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

// Logout route, pakai POST, dengan middleware auth biar aman
// Logout route, panggil method logout dari AuthController
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// Register routes (tampil form dan proses register)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login routes (tampil form dan proses login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Daftar produk, hanya untuk user yang login
Route::get('/products', [ProductController::class, 'index'])->middleware('auth')->name('products.index');

// Group route yang perlu user login
Route::middleware('auth')->group(function () {
    // Halaman form beli produk
    Route::get('/products/{id}/buy', [TransactionController::class, 'create'])->name('products.buy');

    // Proses submit pembelian produk
    Route::post('/products/{id}/buy', [TransactionController::class, 'store'])->name('products.buy.store');

    // Halaman riwayat transaksi user
    Route::get('/transaksiku', [TransactionController::class, 'index'])->name('transaksi.index');
});
