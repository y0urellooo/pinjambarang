<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with([
            'peminjaman.alat', 
            'peminjaman.user'
            ])->latest()->get();
            
        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    public function create(Peminjaman $peminjaman)
    {
        return view('admin.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $peminjaman) {

            Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali' => $request->tanggal_kembali,
            ]);

            // update status peminjaman
            $peminjaman->update([
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => 'dikembalikan'
            ]);

            // stok alat kembali kalau baik
            if ($request->kondisi === 'baik') {
                $peminjaman->alat->increment('jumlah_alat');
            }
        });

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Pengembalian berhasil diproses');
    }
}
