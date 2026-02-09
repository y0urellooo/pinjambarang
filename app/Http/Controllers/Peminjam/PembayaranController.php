<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // halaman list pengembalian dengan denda
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.alat')
            ->whereHas('peminjaman', fn($q) => $q->where('user_id', auth()->id()))
            ->where('denda', '>', 0)
            ->orderBy('tanggal_kembali_aktual', 'desc')
            ->paginate(8);

        return view('peminjam.pengembalian.index', compact('pengembalians'));
    }

    // bayar langsung via tombol
    public function bayar(Pengembalian $pengembalian)
    {
        $user = auth()->user();

        if ($pengembalian->peminjaman->user_id !== $user->id) abort(403);

        if ($pengembalian->denda > 0 && $pengembalian->status_bayar === 'belum') {
            // Kurangi total denda user
            $user->decrement('total_denda', $pengembalian->denda);

            // Update status bayar
            $pengembalian->update(['status_bayar' => 'lunas']);
        }

        return redirect()->route('peminjam.pengembalian.index')
            ->with('success', 'Denda berhasil dibayar');
    }
}
