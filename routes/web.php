<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PeminjamController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Peminjam\AlatController as PeminjamAlatController;
use App\Http\Controllers\Peminjam\PembayaranController;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Peminjam\ProfilController;

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

        // profil admin
        Route::get('/profile', [AdminProfilController::class, 'show'])
            ->name('profile.show');

        Route::get('/profile/edit', [AdminProfilController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile/update', [AdminProfilController::class, 'update'])
            ->name('profile.update');

        Route::resource('petugas', PetugasController::class);
        Route::get('peminjam', [PeminjamController::class, 'index'])
            ->name('peminjam.index');
        Route::resource('/kategori', KategoriController::class);
        Route::resource('/alat', AlatController::class);
        Route::resource('/peminjaman', PeminjamanController::class)
            ->only(['index']);
        Route::patch(
            '/admin/peminjam/{id}/toggle-status',
            [PeminjamController::class, 'toggleStatus']
        )->name('peminjam.toggleStatus');

        // pengembalian
        Route::resource('/pengembalian', PengembalianController::class)->only(['index']);

        // log aktivitas
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])
            ->name('log.index');
    });

// petugas route
Route::prefix('petugas')
    ->middleware(['auth', 'petugas'])
    ->name('petugas.')
    ->group(function () {

        // dashboard petugas
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
            ->name('dashboard');

        // profil petugas
        Route::get('/profile', [\App\Http\Controllers\Petugas\ProfilController::class, 'show'])
            ->name('profile.show');

        Route::get('/profile/edit', [\App\Http\Controllers\Petugas\ProfilController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile/update', [\App\Http\Controllers\Petugas\ProfilController::class, 'update'])
            ->name('profile.update');

        // manajemen peminjaman
        Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        Route::post('/peminjaman/{id}/approve', [PetugasPeminjamanController::class, 'approve'])
            ->name('peminjaman.approve');

        Route::post('/peminjaman/{id}/reject', [PetugasPeminjamanController::class, 'reject'])
            ->name('peminjaman.reject');

        Route::post('/peminjaman/{id}/kembalikan', [PetugasPeminjamanController::class, 'kembalikan'])
            ->name('peminjaman.kembalikan');

        // manajemen pengembalian
        Route::resource('/pengembalian', PetugasPengembalianController::class)
            ->only(['index']);

        Route::get(
            '/pengembalian/{peminjaman}/create',
            [PetugasPengembalianController::class, 'create']
        )->name('pengembalian.create');

        Route::post(
            '/pengembalian/{peminjaman}/store',
            [PetugasPengembalianController::class, 'store']
        )->name('pengembalian.store');

        // laporan pengembalian
        Route::resource('laporan', LaporanController::class)->only(['index']);

        Route::get('/laporan-cetak', [LaporanController::class, 'cetak'])
            ->name('laporan-cetak');
    });

// peminjam route
Route::prefix('peminjam')
    ->middleware(['auth', 'peminjam'])
    ->name('peminjam.')
    ->group(function () {

        // dashboard peminjam
        Route::get(
            '/dashboard',
            [App\Http\Controllers\Peminjam\DashboardController::class, 'index']
        )->name('dashboard');

        // profil peminjam
        Route::get('/profile', function () {
            return view('peminjam.profile.profile');
        })->name('profile');

        Route::get('/profile/edit', [ProfilController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile/update', [ProfilController::class, 'update'])
            ->name('profile.update');

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
            '/peminjaman/{peminjaman}/cancel',
            [PeminjamPeminjamanController::class, 'cancel']
        )->name('peminjaman.cencel');

        Route::post(
            '/peminjaman/{peminjaman}/ajukan-pengembalian',
            [PeminjamPeminjamanController::class, 'ajukanPengembalian']
        )->name('peminjaman.ajukan_pengembalian');

        // riwayat peminjaman peminjam
        Route::get(
            '/peminjaman',
            [PeminjamPeminjamanController::class, 'index']
        )->name('peminjaman.index');

        // Halaman denda/pengembalian
        Route::get('/pengembalian', [PembayaranController::class, 'index'])
            ->name('pengembalian.index');

        // Form bayar denda
        Route::get('/pengembalian/{pengembalian}/bayar', [PembayaranController::class, 'edit'])
            ->name('pengembalian.edit');

        // Update bayar denda
        Route::put('/pengembalian/{pengembalian}', [PembayaranController::class, 'update'])
            ->name('pengembalian.update');

        // Bayar langsung via tombol
        Route::post('/pengembalian/{pengembalian}/bayar', [PembayaranController::class, 'bayar'])
            ->name('pengembalian.bayar');
    });
