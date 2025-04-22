<?php

use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Register
Route::get('/register', [PelangganController::class, 'register'])->name('pelanggan.register');
Route::put('/profile/{id}/edit', [PelangganController::class, 'updateProfile'])->name('pelanggan.updateProfile');

// Auth
Route::get('/login', fn() => view('auth.login'))->name('login.form');
Route::post('/login', [PelangganController::class, 'login'])->name('pelanggan.login');
Route::post('/logout', [PelangganController::class, 'logout'])->name('pelanggan.logout');

Route::get('/dashboard', function () {
    if (!session('pelanggan_id')) return redirect()->route('login.form');
    return view('dashboard');
})->name('dashboard');
