<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class LaporanController extends Controller
{
    private function queryLaporan(Request $request)
    {
        return Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->when($request->tgl_awal && $request->tgl_akhir, function ($query) use ($request) {
                $query->whereBetween('tanggal_kembali_aktual', [
                    $request->tgl_awal,
                    $request->tgl_akhir
                ]);
            })
            ->orderBy('tanggal_kembali_aktual', 'desc');
    }

    public function index(Request $request)
    {
        $pengembalians = $this->queryLaporan($request)->get();
        return view('petugas.laporan.index', compact('pengembalians'));
    }

    public function laporan(Request $request)
    {
        $pengembalians = $this->queryLaporan($request)->get();
        return view('petugas.laporan.index', compact('pengembalians'));
    }

    public function cetak(Request $request)
    {
        $pengembalians = $this->queryLaporan($request)->get();
        return view('petugas.laporan.laporan-print', compact('pengembalians'));
    }
}
