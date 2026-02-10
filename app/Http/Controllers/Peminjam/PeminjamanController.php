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
        $peminjamans = Peminjaman::with(['alat', 'pengembalian'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(8);

        $totalDenda = auth()->user()->total_denda;

        return view('peminjam.peminjaman.index', compact('peminjamans', 'totalDenda'));
    }

    public function create(Alat $alat)
    {
        if ($alat->jumlah_alat < 1) {
            return back()->with('error', 'Stok alat kosong');
        }

        return view('peminjam.peminjaman.create', compact('alat'));
    }

    public function store(Request $request, Alat $alat)
    {
        if ($alat->jumlah_alat < 1) {
            return back()->with('error', 'Stok alat tidak tersedia');
        }

        $request->validate([
            'jumlah_pinjam' => 'required|integer|min:1|max:' . $alat->jumlah_alat,
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
        ], [
            'jumlah_pinjam.required' => 'Jumlah pinjam wajib diisi',
            'jumlah_pinjam.integer' => 'Jumlah pinjam harus berupa angka',
            'jumlah_pinjam.min' => 'Jumlah pinjam minimal 1',
            'jumlah_pinjam.max' => 'Jumlah pinjam melebihi stok alat',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi',
            'tanggal_pinjam.after_or_equal' => 'Tanggal pinjam minimal hari ini',
            'tanggal_kembali_rencana.required' => 'Tanggal kembali wajib diisi',
            'tanggal_kembali_rencana.after_or_equal' => 'Tanggal kembali tidak boleh kurang dari tanggal pinjam',
        ]);

        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status' => 'menunggu',
        ]);

        logAktivitas(
            'Peminjaman',
            'Mengajukan peminjaman alat: ' . $alat->nama . ' (ID: ' . $peminjaman->id . ')'
        );

        return redirect()
            ->route('peminjam.peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim');
    }

    // cancel peminjaman
    public function cancel(Peminjaman $peminjaman)
    {
        if ($peminjaman->user_id !== auth()->id()) {
            abort(403);
        }

        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman tidak dapat dibatalkan');
        }

        logAktivitas(
            'Peminjaman',
            'Membatalkan peminjaman ID: ' . $peminjaman->id
        );

        $peminjaman->delete();

        return back()->with('success', 'Peminjaman berhasil dibatalkan');
    }

    // pengembalian
    public function ajukanPengembalian(Peminjaman $peminjaman)
    {
        if ($peminjaman->user_id !== auth()->id()) {
            abort(403);
        }

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Tidak bisa mengajukan pengembalian');
        }

        $peminjaman->update([
            'status' => 'pengajuan_kembali'
        ]);

        logAktivitas(
            'Pengembalian',
            'Mengajukan pengembalian alat ID: ' . $peminjaman->id
        );

        return back()->with('success', 'Pengajuan pengembalian berhasil dikirim');
    }
}
