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
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
	Route::get('/register', [PelangganController::class, 'showRegisterForm'])->name('register.form');
	Route::post('/register', [PelangganController::class, 'register'])->name('register');
	Route::get('/login', [PelangganController::class, 'showLoginForm'])->name('login.form');
	Route::post('/login', [PelangganController::class, 'login'])->name('login');
	Route::post('/logout', [PelangganController::class, 'logout'])->name('logout')->middleware([IsPelanggan::class]);
	Route::get('/profile', [PelangganController::class, 'showProfile'])->name('profile')->middleware([IsPelanggan::class]);
	Route::post('/profile', [PelangganController::class,'updateProfile'])->name('profile.update')->middleware([IsPelanggan::class]);
});

// Keranjang
Route::prefix('keranjang')->name('pelanggan.keranjang.')->middleware([IsPelanggan::class])->group(function () {
    Route::get('/', [KeranjangController::class, 'showMine'])->name('index');
    Route::post('/add', [KeranjangController::class, 'add'])->name('add');
    Route::delete('/delete/{keranjang_id}', [KeranjangController::class, 'delete'])->name('delete');
});

// Pemesanan
Route::prefix('pemesanan')->name('pelanggan.pemesanan.')->middleware([IsPelanggan::class])->group(function () {
    Route::get('/', [PemesananController::class, 'showMine'])->name('index');
    Route::get('/{id_pemesanan}', [PemesananController::class, 'show'])->name('detail');
    Route::get('/checkout', [PemesananController::class, 'showPemesananForm'])->name('checkout.form');
    Route::post('/checkout', [PemesananController::class, 'createFromKeranjang'])->name('checkout');
    Route::post('/cancel/{id_pemesanan}', [PemesananController::class, 'cancel'])->name('cancel');
});

// Pembayaran
Route::prefix('pembayaran')->name('pelanggan.pembayaran.')->middleware([IsPelanggan::class])->group(function () {
    Route::get('/', [PembayaranController::class, 'showMine'])->name('index');
    Route::get('/{id_pembayaran}', [PembayaranController::class, 'show'])->name('detail');
    Route::get('/bayar/{id_pemesanan}', [PembayaranController::class, 'showPembayaranForm'])->name('bayar.form');
    Route::post('/bayar/{id_pemesanan}', [PembayaranController::class, 'create'])->name('bayar');
});
