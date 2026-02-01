<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PeminjamController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Peminjam\AlatController as PeminjamAlatController;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;

// ROUTES
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Route
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// admin route
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Route::resource('/users', UserController::class);
        Route::resource('petugas', PetugasController::class);
        Route::get('peminjam', [PeminjamController::class, 'index'])
            ->name('peminjam.index');
        Route::resource('/kategori', KategoriController::class);
        Route::resource('/alat', AlatController::class);
        Route::resource('/peminjaman', PeminjamanController::class)
        ->only(['index']);
        Route::resource('/pengembalian', PengembalianController::class)->only(['index']);
        Route::get(
            '/pengembalian/{peminjaman}',
            [PengembalianController::class, 'create']
        )->name('pengembalian.create');

        Route::post(
            '/pengembalian/{peminjaman}',
            [PengembalianController::class, 'store']
        )->name('pengembalian.store');
    });

// petugas route
Route::prefix('petugas')
    ->middleware(['auth', 'petugas'])
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('petugas.dashboard');
        })->name('dashboard');
    });

// peminjam route
Route::prefix('peminjam')
    ->middleware(['auth', 'peminjam'])
    ->name('peminjam.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('peminjam.dashboard');
        })->name('dashboard');

        // lihat alat
        Route::get('/alat', [PeminjamAlatController::class, 'index'])
            ->name('alat.index');

        // ajukan peminjaman
        Route::get(
            '/peminjaman/create/{alat}',
            [PeminjamPeminjamanController::class, 'create']
        )->name('peminjaman.create');

        Route::post(
            '/peminjaman/store/{alat}',
            [PeminjamPeminjamanController::class, 'store']
        )->name('peminjaman.store');

        Route::delete(
            '/peminjaman/{peminjaman}/cencel',
            [PeminjamPeminjamanController::class, 'cencel']
        )->name('peminjaman.cencel');

        // riwayat peminjaman peminjam
        Route::get(
            '/peminjaman',
            [PeminjamPeminjamanController::class, 'index']
        )->name('peminjaman.index');
    });
