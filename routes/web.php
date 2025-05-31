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
	Route::post('/logout', [PelangganController::class, 'logout'])->name('logout');
	Route::get('/profile', [PelangganController::class, 'showProfile'])->name('profile')->middleware([IsPelanggan::class]);
	Route::post('/profile', [PelangganController::class,'updateProfile'])->name('profile.update')->middleware([IsPelanggan::class]);
});

// Pemesanan
Route::get('/pemesanan', [PemesananController::class, 'showMine'])->name('pelanggan.pemesanan')->middleware([IsPelanggan::class]);
Route::get('/pemesanan/{id_pemesanan}', [PemesananController::class, 'show'])->name('pelanggan.pemesanan.detail')->middleware([IsPelanggan::class]);
Route::post('/pemesanan/create', [PemesananController::class, 'createFromKeranjang'])->name('pelanggan.pemesanan.create')->middleware([IsPelanggan::class]);
Route::get('/pemesanan/cancel/{id_pemesanan}', [PemesananController::class, 'cancel'])->name('pelanggan.pemesanan.cancel')->middleware([IsPelanggan::class]);

// Keranjang
Route::get('/keranjang', [KeranjangController::class, 'showMine'])->name('pelanggan.keranjang')->middleware([IsPelanggan::class]);
Route::post('/keranjang/add', [KeranjangController::class, 'add'])->name('pelanggan.keranjang.add')->middleware([IsPelanggan::class]);
Route::delete('/keranjang/delete/{keranjang_id}', [KeranjangController::class, 'delete'])->name('pelanggan.keranjang.delete')->middleware([IsPelanggan::class]);

// Pembayaran
//Route::get('admin/pembayaran', [PembayaranController::class, 'showAll'])->name('admin.pembayaran')->middleware([IsAdmin::class]);
Route::get('/pembayaran', [PembayaranController::class, 'showMine'])->name('pelanggan.pembayaran')->middleware([IsPelanggan::class]);
Route::get('/pembayaran/{id_pembayaran}', [PembayaranController::class, 'show'])->name('pelanggan.pembayaran.detail')->middleware([IsPelanggan::class]);
Route::post('/pembayaran/create', [PembayaranController::class, 'create'])->name('pelanggan.pembayaran.create')->middleware([IsPelanggan::class]);

// Landing Page 🙏
Route::get('/landingpage', function () {
	return view('landingpage.landingpage');
});

// Keranjang
Route::get('/viewkeranjang', function () {
	return view('keranjang');
});

// Profile User
Route::get('/profiluser', function () {
	return view('profiluser.profiluser');
});

// Riwayat Pemesanan
Route::get('/riwayatpemesanan', function () {
	return view('profiluser.riwayatpesanan');
});

// Form Pemesanan
Route::get('/pesan', function () {
	return view('pemesanan.formpemesanan');
})->name('pelanggan.formpemesanan')
  ->middleware([IsPelanggan::class]);

// Pembayaran
Route::get('/bayar/{id_pemesanan}', [PembayaranController::class, 'showPembayaranForm'])
    ->name('pelanggan.pembayaran.bayar')
    ->middleware([IsPelanggan::class]);
