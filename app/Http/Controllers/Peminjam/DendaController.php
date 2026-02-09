<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.alat')
            ->whereHas('peminjaman', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->where('denda', '>', 0)
            ->orderBy('tanggal_kembali_aktual', 'desc')
            ->get();

        return view('peminjam.pembayaran.index', compact('pengembalians'));
    }

    // tampil form bayar / detail denda
    public function edit(Pengembalian $pengembalian)
    {
        if ($pengembalian->peminjaman->user_id !== auth()->id()) {
            abort(403);
        }

        return view('peminjam.pembayaran.edit', compact('pengembalian'));
    }

    // update status bayar via form
    public function update(Request $request, Pengembalian $pengembalian)
    {
        if ($pengembalian->peminjaman->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status_bayar' => 'required|in:belum,lunas'
        ]);

        // kalau sebelumnya belum lalu jadi lunas → kurangi total denda user
        if ($pengembalian->status_bayar === 'belum' && $request->status_bayar === 'lunas') {
            auth()->user()->decrement('total_denda', $pengembalian->denda);
        }

        $pengembalian->update([
            'status_bayar' => $request->status_bayar
        ]);

        return redirect()
            ->route('peminjam.pembayaran.index')
            ->with('success', 'Status denda diperbarui');
    }

    // bayar langsung via tombol
    public function bayar(Pengembalian $pengembalian)
    {
        $user = auth()->user();

        if ($pengembalian->peminjaman->user_id !== $user->id) {
            abort(403);
        }

        if ($pengembalian->denda > 0 && $pengembalian->status_bayar === 'belum') {
            $user->decrement('total_denda', $pengembalian->denda);
            $pengembalian->update([
                'status_bayar' => 'lunas'
            ]);
        }

        return back()->with('success', 'Denda berhasil dibayar');
    }
}
