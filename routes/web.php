<?php

use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});
// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Admin Routes
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth']);

// Petugas Routes
Route::get('/petugas/dashboard', function () {
    return view('petugas.dashboard');
})->middleware(['auth']);

// Peminjam Routes
Route::get('/peminjam/dashboard', function () {
    return view('peminjam.dashboard');
})->middleware(['auth']);


Route::resource('/admin/users', UserController::class);
Route::resource('/admin/kategori', KategoriController::class);