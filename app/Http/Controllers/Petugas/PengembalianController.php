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
