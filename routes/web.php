<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;

Route::resource('/books', BookController::class);


// Rute Auth (Login & Register)
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Rute Dashboard (dilindungi oleh middleware auth)
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin'); // Periksa middleware 'role:admin'
});
