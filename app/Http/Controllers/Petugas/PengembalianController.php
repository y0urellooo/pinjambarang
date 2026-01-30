<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::where('status', 'disetujui')->get();
        return view('petugas.pengembalian.index', compact('peminjaman'));
    }

    public function update($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'dikembalikan';
        $peminjaman->save();

        return redirect()->back();
    }
}
