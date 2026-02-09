<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // list semua peminjaman
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->paginate(8);

        return view('petugas.peminjaman.index', compact('peminjamans'));
    }

    // approve peminjaman
    public function approve($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if (!$peminjaman->alat) {
            abort(400, 'Alat tidak ditemukan');
        }

        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Status peminjaman tidak valid');
        }

        if ($peminjaman->alat->jumlah_alat < $peminjaman->jumlah_pinjam) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        DB::transaction(function () use ($peminjaman) {

            // update status
            $peminjaman->update([
                'status' => 'dipinjam'
            ]);

            // kurangi stok
            $peminjaman->alat->decrement(
                'jumlah_alat',
                $peminjaman->jumlah_pinjam
            );

            // log aktivitas
            logAktivitas(
                'Peminjaman',
                'Menyetujui peminjaman ID: ' . $peminjaman->id
            );
        });

        return back()->with('success', 'Peminjaman disetujui');
    }

    // reject peminjaman
    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Status peminjaman tidak valid');
        }

        $peminjaman->update([
            'status' => 'ditolak'
        ]);

        logAktivitas(
            'Peminjaman',
            'Menolak peminjaman ID: ' . $peminjaman->id
        );

        return back()->with('success', 'Peminjaman ditolak');
    }

    // petugas konfirmasi pengajuan pengembalian
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Peminjaman belum aktif');
        }

        $peminjaman->update([
            'status' => 'pengajuan_kembali'
        ]);

        logAktivitas(
            'Pengembalian',
            'Petugas memproses pengajuan pengembalian ID: ' . $peminjaman->id
        );

        return back()->with('success', 'Pengajuan pengembalian berhasil');
    }
}
