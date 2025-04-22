<?php

use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

// Register
Route::get('/register', [PelangganController::class, 'showRegisterForm'])->name('pelanggan.register');
Route::post('/register', [PelangganController::class, 'register']);
// Route::put('/profile/{id}/edit', [PelangganController::class, 'updateProfile'])->name('pelanggan.updateProfile');

// Auth
Route::get('/login', [PelangganController::class, 'showLoginForm'])->name('pelanggan.login');
Route::post('/login', [PelangganController::class, 'login']);
Route::post('/logout', [PelangganController::class, 'logout'])->name('pelanggan.logout');
