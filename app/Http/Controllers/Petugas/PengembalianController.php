<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with([
            'peminjaman.user',
            'peminjaman.alat'
        ])->orderBy('tanggal_kembali', 'desc')->get();

        return view('petugas.pengembalian.index', compact('pengembalians'));
    }

    public function create(Peminjaman $peminjaman)
    {
        // validasi status
        if ($peminjaman->status !== 'pengajuan_kembali') {
            return redirect()
                ->route('petugas.peminjaman.index')
                ->with('error', 'Peminjaman belum mengajukan pengembalian');
        }

        return view('petugas.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
            'kondisi' => 'required|in:baik,rusak,hilang',
            'catatan' => 'nullable|string',
            'denda' => 'nullable|integer|min:0'
        ]);

        DB::transaction(function () use ($request, $peminjaman) {

            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali' => $request->tanggal_kembali,
                'kondisi' => $request->kondisi,
                'catatan' => $request->catatan,
                'denda' => $request->denda ?? 0,
            ]);

            // stok kembali kalau tidak hilang
            if ($request->kondisi !== 'hilang') {
                $peminjaman->alat->increment(
                    'jumlah_alat',
                    $peminjaman->jumlah_pinjam
                );
            }

            $peminjaman->update([
                'status' => 'dikembalikan'
            ]);
        });

        return redirect()
            ->route('petugas.peminjaman.index')
            ->with('success', 'Pengembalian berhasil diproses');
    }

    // laporan
    public function laporan(Request $request)
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->when($request->tgl_awal && $request->tgl_akhir, function ($query) use ($request) {
                $query->whereBetween('tanggal_kembali', [
                    $request->tgl_awal,
                    $request->tgl_akhir
                ]);
            })
            ->orderBy('tanggal_kembali', 'desc')
            ->get();

        return view('petugas.laporan.index', compact('pengembalians'));
    }

    // laporan
    public function cetak(Request $request)
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->whereBetween('tanggal_kembali', [
                $request->tgl_awal,
                $request->tgl_akhir
            ])
            ->orderBy('tanggal_kembali', 'desc')
            ->get();

        return view('petugas.laporan.cetak_pengembalian', compact('pengembalians'));
    }
}
