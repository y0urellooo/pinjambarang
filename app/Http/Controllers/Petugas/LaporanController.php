<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class LaporanController extends Controller
{
    // halaman laporan (tabel + tombol cetak)
    public function index(Request $request)
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->when($request->tgl_awal && $request->tgl_akhir, function ($query) use ($request) {
                $query->whereBetween('tanggal_kembali', [$request->tgl_awal, $request->tgl_akhir]);
            })
            ->orderBy('tanggal_kembali', 'desc')
            ->get();

        return view('petugas.laporan.index', compact('pengembalians'));
    }

    // halaman cetak
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

    // cetak laporan
    public function cetak(Request $request)
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

        return view('petugas.laporan.laporan-print', compact('pengembalians'));
    }
}
