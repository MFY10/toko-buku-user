<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Rute Auth (Login & Register) menggunakan controller group
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Rute Dashboard (hanya bisa diakses oleh yang login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rute admin, hanya bisa diakses oleh user dengan role 'admin'
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->middleware('role:admin')->name('admin.dashboard');
});

// Rute Manajemen Buku (hanya bisa diakses oleh yang login)
Route::middleware(['auth'])->prefix('manage-books')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('manage.books');
    Route::get('/create', [BookController::class, 'create'])->name('create.book');
    Route::post('/', [BookController::class, 'store'])->name('store.book');
    Route::get('/{id}/edit', [BookController::class, 'edit'])->name('edit.book');
    Route::put('/{id}', [BookController::class, 'update'])->name('update.book');
    Route::delete('/{id}', [BookController::class, 'destroy'])->name('delete.book');
});

// Rute untuk resource books (CRUD sederhana untuk buku)
Route::resource('/books', BookController::class);
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
});
