<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        return view('peminjam.dashboard', [
            'totalPeminjaman' => Peminjaman::where('user_id', $userId)->count(),
            'dipinjam' => Peminjaman::where('user_id', $userId)->where('status', 'dipinjam')->count(),
            'dikembalikan' => Peminjaman::where('user_id', $userId)->where('status', 'dikembalikan')->count(),
            'terlambat' => Peminjaman::where('user_id', $userId)->where('status', 'terlambat')->count(),
            'peminjamanTerbaru' => Peminjaman::where('user_id', $userId)
                ->latest()
                ->take(5)
                ->get()
        ]);
    }
}
