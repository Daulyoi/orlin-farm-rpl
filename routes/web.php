<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HewanQurbanController;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
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

