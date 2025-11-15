<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ============
// Home Page
// ============
Route::get('/', function () {
    return redirect()->route('login');
});

// ============
// Dashboard
// ============
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============
// Profile
// ============
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============
// Auth Routes Breeze (Login & Register)
// ============
require __DIR__ . '/auth.php';
