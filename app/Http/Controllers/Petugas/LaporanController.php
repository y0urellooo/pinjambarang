<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $pengembalians = $this->queryLaporan($request)->paginate(8);

        logAktivitas(
            'Laporan',
            'Membuka halaman laporan pengembalian'
        );

        return view('petugas.laporan.index', compact('pengembalians'));
    }

    public function laporan(Request $request)
    {
        $pengembalians = $this->queryLaporan($request)->get();

        logAktivitas(
            'Laporan',
            'Melihat data laporan pengembalian'
        );

        return view('petugas.laporan.index', compact('pengembalians'));
    }

    public function cetak(Request $request)
    {
        $pengembalians = $this->queryLaporan($request)->get();

        logAktivitas(
            'Laporan',
            'Mencetak laporan pengembalian'
        );

        return view('petugas.laporan.laporan-print', compact('pengembalians'));
    }
}
