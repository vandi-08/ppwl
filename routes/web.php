<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\User\ActivityController;

// =========================
// 🔹 Halaman Utama & Blog
// =========================
Route::get('/', [UserController::class, 'index'])->name('landing');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

// Artikel blog
Route::get('/blog/happy-relationship', [BlogController::class, 'happyRelationship'])->name('blog.happy');
Route::get('/blog/better-sleep', [BlogController::class, 'betterSleep'])->name('blog.sleep');
Route::get('/blog/break-bad-habits', [BlogController::class, 'breakHabits'])->name('blog.habits');
Route::get('/blog/track-mood', [BlogController::class, 'trackMood'])->name('blog.track');
Route::get('/blog/start-tracking', [BlogController::class, 'startTracking'])->name('blog.start');


// =========================
// 🔹 Autentikasi
// =========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// =========================
// 🔹 USER AREA (Auth)
// =========================
Route::middleware('auth')->group(function () {

    // Dashboard user
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Alias home
    Route::get('/home', function () {
        return redirect()->route('user.dashboard');
    })->name('home');

    // Halaman user
    Route::get('/riwayat', [UserController::class, 'riwayatMood'])->name('user.riwayatMood');
    Route::get('/aktivitas', [UserController::class, 'aktivitas'])->name('user.aktivitas');
    Route::get('/profil', [UserController::class, 'profil'])->name('user.profil');
    Route::get('/insight', [UserController::class, 'insight'])->name('user.insight');
    Route::get('/game', [UserController::class, 'game'])->name('user.game');

    // Aksi mood & jurnal
    Route::post('/mood', [UserController::class, 'storeMood'])->name('store.mood');
    Route::post('/journal', [UserController::class, 'storeJournal'])->name('store.journal');

    // Update profil & password
    Route::post('/profil/update', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::post('/profil/password', [UserController::class, 'updatePassword'])->name('user.updatePassword');

    // =========================
    // 🔹 Activity Routes (User)
    // =========================
    Route::get('/activity', [ActivityController::class, 'index'])->name('user.activity.index');
    Route::post('/aktivitas/toggle', [ActivityController::class, 'toggle'])->name('user.activity.toggle');
});


// =========================
// 🔹 ADMIN AREA (Auth)
// =========================
Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/activities', [AdminController::class, 'activities'])->name('admin.activities');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');

    // CRUD Aktivitas Admin
    Route::post('/activities', [AdminController::class, 'storeActivity'])->name('admin.activities.store');
    Route::put('/activities/{id}', [AdminController::class, 'updateActivity'])->name('admin.activities.update');
    Route::delete('/activities/{id}', [AdminController::class, 'destroyActivity'])->name('admin.activities.destroy');
});
