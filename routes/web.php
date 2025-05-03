<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HewanQurbanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-session', function () {
    session(['pelanggan_id' => 12345]); // Manually set session
    dd(session('pelanggan_id')); // This should output 12345
});

Route::get('/home', [HewanQurbanController::class, 'showAll'])->name('home');

// Register
Route::get('/register', [PelangganController::class, 'showRegisterForm'])->name('pelanggan.register');
Route::post('/register', [PelangganController::class, 'register']);
// Route::put('/profile/{id}/edit', [PelangganController::class, 'updateProfile'])->name('pelanggan.updateProfile');

// Auth Pelanggan
Route::get('/login', [PelangganController::class, 'showLoginForm'])->name('pelanggan.login');
Route::post('/login', [PelangganController::class, 'login']);
Route::post('/logout', [PelangganController::class, 'logout'])->name('pelanggan.logout');

// Admin
// Perlu diubah biar register nggak bisa di akses
Route::get('/admin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

// Pemesanan
Route::get('/pemesanan', [PemesananController::class, 'showMine'])->name('pelanggan.pemesanan');
Route::get('/pemesanan/{id_pemesanan}', [PemesananController::class, 'show'])->name('pelanggan.pemesanan.detail');
Route::post('/pemesanan/create', [PemesananController::class, 'createFromKeranjang'])->name('pelanggan.pemesanan.create');
Route::get('/pemesanan/cancel/{id_pemesanan}', [PemesananController::class, 'cancel'])->name('pelanggan.pemesanan.cancel');

// Keranjang
Route::get('/keranjang', [KeranjangController::class, 'showMine'])->name('pelanggan.keranjang');
Route::post('/keranjang/add', [KeranjangController::class, 'add'])->name('pelanggan.keranjang.add');
Route::delete('/keranjang/delete/{keranjang_id}', [KeranjangController::class, 'delete'])->name('pelanggan.keranjang.delete');

// Pembayaran
Route::get('admin/pembayaran', [PembayaranController::class, 'showAll'])->name('admin.pembayaran');
Route::get('/pembayaran', [PembayaranController::class, 'showMine'])->name('pelanggan.pembayaran');
Route::get('/pembayaran/{id_pembayaran}', [PembayaranController::class, 'show'])->name('pelanggan.pembayaran.detail');
Route::post('/pembayaran/create', [PembayaranController::class, 'create'])->name('pelanggan.pembayaran.create');



