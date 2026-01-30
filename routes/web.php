<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;

use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController;
use App\Http\Controllers\Petugas\MencetakController;

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

// ================= ROOT =================
Route::get('/', function () {
    return redirect()->route('login');
});

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= ADMIN =================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Resource Routes
        Route::resource('users', UserController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('alat', AlatController::class);
    });

// ================= PETUGAS =================
Route::prefix('petugas')
    ->name('petugas.')
    ->middleware(['auth', 'petugas'])
    ->group(function () {

        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
            ->name('dashboard');

        // Resource Routes Petugas
        Route::resource('peminjaman', PeminjamanController::class);
        Route::resource('pengembalian', PengembalianController::class);
        Route::resource('mencetak', MencetakController::class);
    });

Route::prefix('peminjam')
    ->middleware(['auth', 'peminjam'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('peminjam.dashboard');
        })->name('peminjam.dashboard');
    });
