<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with([
            'peminjaman.user',
            'peminjaman.alat'
        ])
            ->orderBy('tanggal_kembali_aktual', 'desc')
            ->paginate(8);

        logAktivitas(
            'Pengembalian',
            'Membuka halaman data pengembalian'
        );

        return view('petugas.pengembalian.index', compact('pengembalians'));
    }

    public function create(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'pengajuan_kembali') {
            return redirect()
                ->route('petugas.peminjaman.index')
                ->with('error', 'Peminjaman belum mengajukan pengembalian');
        }

        logAktivitas(
            'Pengembalian',
            'Membuka form pengembalian alat ID: ' . $peminjaman->id
        );

        return view('petugas.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_kembali_aktual' => 'required|date',
            'kondisi' => 'required|in:baik,rusak,hilang',
            'catatan' => 'nullable|string',
            'denda' => 'nullable|integer|min:0'
        ]);

        DB::transaction(function () use ($request, $peminjaman) {

            $tanggal_rencana = Carbon::parse($peminjaman->tanggal_kembali_rencana);
            $tanggal_aktual = Carbon::parse($request->tanggal_kembali_aktual);

            $denda_telat = 0;

            if ($tanggal_aktual->gt($tanggal_rencana)) {
                $hari_telat = $tanggal_rencana->diffInDays($tanggal_aktual);
                $denda_telat = $hari_telat * 10000;
            }

            $total_denda = ($request->denda ?? 0) + $denda_telat;

            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali_aktual' => $tanggal_aktual,
                'kondisi' => $request->kondisi,
                'catatan' => $request->catatan,
                'denda' => $total_denda,
                'status_bayar' => $total_denda > 0 ? 'belum' : 'lunas',
            ]);

            if ($request->kondisi !== 'hilang') {
                $peminjaman->alat->increment(
                    'jumlah_alat',
                    $peminjaman->jumlah_pinjam
                );
            }

            $peminjaman->update([
                'status' => 'dikembalikan'
            ]);

            if ($total_denda > 0) {
                $peminjaman->user->increment('total_denda', $total_denda);
            }

            logAktivitas(
                'Pengembalian',
                'Memproses pengembalian alat ID: ' . $peminjaman->id
            );
        });

        return redirect()
            ->route('petugas.pengembalian.index')
            ->with('success', 'Pengembalian berhasil diproses');
    }

    public function laporan(Request $request)
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->when($request->tgl_awal && $request->tgl_akhir, function ($query) use ($request) {
                $query->whereBetween('tanggal_kembali_aktual', [
                    $request->tgl_awal,
                    $request->tgl_akhir
                ]);
            })
            ->orderBy('tanggal_kembali_aktual', 'desc')
            ->get();

        logAktivitas(
            'Laporan',
            'Membuka laporan pengembalian'
        );

        return view('petugas.laporan.index', compact('pengembalians'));
    }

    public function cetak(Request $request)
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
            ->whereBetween('tanggal_kembali_aktual', [
                $request->tgl_awal,
                $request->tgl_akhir
            ])
            ->orderBy('tanggal_kembali_aktual', 'desc')
            ->get();

        logAktivitas(
            'Laporan',
            'Mencetak laporan pengembalian'
        );

        return view('petugas.laporan.cetak_pengembalian', compact('pengembalians'));
    }
}
