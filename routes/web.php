<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Admin\AdminPerangkatController;
use App\Http\Controllers\Admin\AdminStatistikController;
use App\Http\Controllers\Admin\AdminUmkmController;
use App\Http\Controllers\KartarController;
use App\Http\Controllers\KritikSaranController;
use App\Http\Controllers\Admin\AdminKartarController;
use App\Http\Controllers\Admin\AdminKartarKegiatanController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminKritikSaranController;
use App\Http\Controllers\Auth\UserAuthController;

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Berita
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [HomeController::class, 'beritaDetail'])->name('berita.detail');

// Perangkat Desa
Route::get('/perangkat', [HomeController::class, 'perangkat'])->name('perangkat');

// Statistik
Route::get('/statistik', [HomeController::class, 'statistik'])->name('statistik');

// UMKM
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{umkm}', [UmkmController::class, 'show'])->name('umkm.show');

// Kartar (Karang Taruna)
Route::get('/kartar', [KartarController::class, 'index'])->name('kartar.index');

// Kritik & Saran
Route::get('/kritik-saran', [KritikSaranController::class, 'index'])->name('kritik-saran.index');
Route::post('/kritik-saran', [KritikSaranController::class, 'store'])->name('kritik-saran.store');

// User Authentication Routes
Route::prefix('auth')->name('user.')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');
    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register.post');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
    
    // Google OAuth untuk user
    Route::get('/google', [UserAuthController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/google/callback', [UserAuthController::class, 'handleGoogleCallback'])->name('google.callback');
    
    // Profile
    Route::get('/profile', [UserAuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserAuthController::class, 'updateProfile'])->name('profile.update');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Redirect /admin to /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    
    // Login (tanpa middleware)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Google OAuth
    Route::get('/auth/google', [AdminAuthController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/auth/google/callback', [AdminAuthController::class, 'handleGoogleCallback'])->name('google.callback');

    // Protected routes (dengan middleware admin + nocache)
    Route::middleware(['admin', 'nocache'])->group(function () {
        // Dashboard - bisa diakses Administrator & Kartar
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });

    // Routes khusus Administrator (akses semua)
    Route::middleware(['admin', 'nocache', 'role:administrator'])->group(function () {
        // Berita Management
        Route::resource('/berita', AdminBeritaController::class);

        // Perangkat Management
        Route::resource('/perangkat', AdminPerangkatController::class);

        // Statistik Management
        Route::get('/statistik', [AdminStatistikController::class, 'edit'])->name('statistik.edit');
        Route::put('/statistik', [AdminStatistikController::class, 'update'])->name('statistik.update');

        // UMKM Management
        Route::resource('/umkm', AdminUmkmController::class);

        // User Admin Management
        Route::resource('/users', AdminUserController::class)->except(['show']);

        // Kritik & Saran Management
        Route::get('/kritik-saran', [AdminKritikSaranController::class, 'index'])->name('kritik-saran.index');
        Route::get('/kritik-saran/{kritik_saran}', [AdminKritikSaranController::class, 'show'])->name('kritik-saran.show');
        Route::put('/kritik-saran/{kritik_saran}/tanggapi', [AdminKritikSaranController::class, 'tanggapi'])->name('kritik-saran.tanggapi');
        Route::delete('/kritik-saran/{kritik_saran}', [AdminKritikSaranController::class, 'destroy'])->name('kritik-saran.destroy');
    });

    // Routes untuk Kartar (hanya akses menu Kartar)
    Route::middleware(['admin', 'nocache', 'role:administrator,kartar'])->group(function () {
        // Kartar Management
        Route::resource('/kartar', AdminKartarController::class);
        Route::resource('/kartar-kegiatan', AdminKartarKegiatanController::class);
    });
});

