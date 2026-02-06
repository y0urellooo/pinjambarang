<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function create(Alat $alat)
    {
        return view('peminjam.peminjaman.create', compact('alat'));
    }

    public function store(Request $request, Alat $alat)
    {
        $request->validate([
            'jumlah_pinjam' => 'required|integer' . $alat->jumlah_pinjam,
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
        ]);

        Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('peminjam.peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim');
    }

    // cencel peminjaman
    public function cencel(Peminjaman $peminjaman)
    {
        if ($peminjaman->user_id !== auth()->id()) {
            abort(403);
        }

        // hanya boleh dibatalkan jika masih menunggu
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman tidak dapat dibatalkan');
        }

        $peminjaman->delete();

        return back()->with('success', 'Peminjaman berhasil dibatalkan');
    }
}
