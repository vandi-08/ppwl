<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;  
use App\Http\Controllers\CategoryController;  

// =============================
// Home (Halaman Utama Dashboard Sneat)
// =============================
Route::get('/', function () {
    return view('home');
})->name('home');


// =============================
// Dashboard User
// =============================
Route::get('/dashboard', function () {
    return view('dashboard'); // layout app.blade.php
})->middleware('auth')->name('dashboard'); // hapus 'verified'


// =============================
// Dashboard Admin
// =============================
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // layout dashboard Sneat
})->middleware(['auth', AdminMiddleware::class])->name('admin.dashboard');


// =============================
// CRUD Produk
// =============================
// Route otomatis: index, create, store, show, edit, update, destroy
Route::resource('/products', ProductController::class);


// =============================
// CRUD Category
// =============================
Route::resource('/category', CategoryController::class);



// =============================
// Profile Routes
// =============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =============================
// Auth Routes Breeze (Login / Register)
// =============================
require __DIR__ . '/auth.php';
