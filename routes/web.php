<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;

use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\MencetakController;

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

// ROOT redirect to login
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
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('alat', AlatController::class);
        Route::resource('peminjaman', PeminjamanController::class);

        Route::resource('pengembalian', PengembalianController::class)->only(['index']);
        Route::get('/pengembalian/{peminjaman}', [PengembalianController::class, 'create'])->name('pengembalian.create');
        Route::post('/pengembalian/{peminjaman}', [PengembalianController::class, 'store'])->name('pengembalian.store');
    });

// ================= PETUGAS =================
Route::prefix('petugas')
    ->middleware(['auth', 'petugas'])
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');

        Route::resource('peminjaman', PetugasPeminjamanController::class);
        Route::resource('pengembalian', PetugasPengembalianController::class);
        Route::resource('mencetak', MencetakController::class);
        Route::get('/mencetak/cetak', [MencetakController::class, 'cetak'])
            ->name('mencetak.cetak');

    });

// ================= PEMINJAM =================
Route::prefix('peminjam')
    ->middleware(['auth', 'peminjam'])
    ->name('peminjam.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('peminjam.dashboard');
        })->name('dashboard');
    });
