<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // list semua peminjaman
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        return view('petugas.peminjaman.index', compact('peminjamans'));
    }

    // acc peminjaman 
    public function approve($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if (!$peminjaman->alat) {
            abort(400, 'Alat tidak ditemukan');
        }
        if ($peminjaman->alat->jumlah_alat < $peminjaman->jumlah_pinjam) {
            abort(400, 'Stok tidak mencukupi');
        }
        $peminjaman->update(['status' => 'dipinjam']);
        $peminjaman->alat->decrement('jumlah_alat', $peminjaman->jumlah_pinjam);
        return back()->with('success', 'Peminjaman disetujui');
    }

    // tolak
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';
        $peminjaman->save();

        return back()->with('success', 'Peminjaman ditolak');
    }

    // proses pengembalian
    
    // proses pengajuan pengembalian (oleh peminjam)
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Peminjaman belum aktif');
        }

        $peminjaman->update([
            'status' => 'pengajuan_kembali'
        ]);

        return back()->with('success', 'Pengajuan pengembalian berhasil');
    }
}
