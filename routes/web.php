<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HewanQurbanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsPelanggan;

Route::get('/', [HewanQurbanController::class, 'showAll'])->name('home');

// Pelanggan
Route::name('pelanggan.')->group(function () {
	Route::get('/register', [PelangganController::class, 'showRegisterForm'])->name('register.form');
	Route::post('/register', [PelangganController::class, 'register'])->name('register');
	Route::get('/login', [PelangganController::class, 'showLoginForm'])->name('login.form');
	Route::post('/login', [PelangganController::class, 'login'])->name('login');
	Route::post('/logout', [PelangganController::class, 'logout'])->name('logout')->middleware([IsPelanggan::class]);
	Route::get('/profile', [PelangganController::class, 'show'])->name('profile')->middleware([IsPelanggan::class]);
	Route::post('/profile', [PelangganController::class,'update'])->name('profile.update')->middleware([IsPelanggan::class]);
});

// Keranjang
Route::prefix('keranjang')->name('pelanggan.keranjang.')->middleware([IsPelanggan::class])->group(function () {
    Route::get('/', [KeranjangController::class, 'index'])->name('index');
    Route::post('/', [KeranjangController::class, 'store'])->name('store');
    Route::delete('/{keranjang_id}', action: [KeranjangController::class, 'destroy'])->name('destroy');
});

// Pemesanan
Route::prefix('pemesanan')->name('pelanggan.pemesanan.')->middleware([IsPelanggan::class])->group(function () {
    Route::get('/', [PemesananController::class, 'index'])->name('index');
    Route::get('/checkout', [PemesananController::class, 'create'])->name('create');
    Route::post('/checkout', [PemesananController::class, 'store'])->name('store');
    Route::get('/{id_pemesanan}', [PemesananController::class, 'show'])->name('show');
    Route::put('/{id_pemesanan}/cancel', [PemesananController::class, 'cancel'])->name('cancel');
});

// Pembayaran
Route::prefix('pembayaran')->name('pelanggan.pembayaran.')->middleware([IsPelanggan::class])->group(function () {
    Route::get('/', [PembayaranController::class, 'index'])->name('index');
    Route::get('/{id_pembayaran}', [PembayaranController::class, 'show'])->name('show');
    Route::get('/{id_pemesanan}/bayar', [PembayaranController::class, 'create'])->name('create');
    Route::post('/{id_pemesanan}/bayar', [PembayaranController::class, 'store'])->name('store');
});
