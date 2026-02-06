<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->latest()
            ->get();

        return view('peminjam.pengembalian.index', compact('peminjamans'));
    }

    public function store($id)
    {
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);

        return back()->with('success', 'Alat berhasil dikembalikan');
    }
}
