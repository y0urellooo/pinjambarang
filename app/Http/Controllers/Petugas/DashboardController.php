<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeminjaman = Peminjaman::count();

        $dipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $dikembalikan = Peminjaman::where('status', 'dikembalikan')->count();
        $terlambat = Peminjaman::where('status', 'terlambat')->count();

        $peminjamanTerbaru = Peminjaman::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact(
            'totalPeminjaman',
            'dipinjam',
            'dikembalikan',
            'terlambat',
            'peminjamanTerbaru'
        ));
    }
}