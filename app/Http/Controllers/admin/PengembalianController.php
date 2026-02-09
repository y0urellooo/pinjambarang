<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Traits\ActivitylogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    use ActivitylogTrait;

    public function index()
    {
        $this->logView('Pengembalian', 'Melihat daftar pengembalian');
        $pengembalians = Pengembalian::with([
            'peminjaman.alat',
            'peminjaman.user'
        ])
        ->orderBy('tanggal_kembali_aktual', 'desc')
        ->paginate(8);

        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    public function create(Peminjaman $peminjaman)
    {
        return view('admin.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_kembali_aktual' => 'required|date',
            'kondisi' => 'required|in:baik,rusak,hilang',
            'catatan' => 'nullable|string',
            'denda' => 'nullable|integer|min:0',
        ]);

        DB::transaction(function () use ($request, $peminjaman) {

            // simpan ke tabel pengembalians
            $pengembalian = Pengembalian::create([
                'peminjaman_id' => $peminjaman->id,
                'tanggal_kembali_aktual' => $request->tanggal_kembali_aktual,
                'kondisi' => $request->kondisi,
                'catatan' => $request->catatan,
                'denda' => $request->denda ?? 0,
            ]);

            // Log aktivitas pengembalian
            $this->logCreate('Pengembalian', Pengembalian::class, $pengembalian->id, $pengembalian->toArray(), 
                "Membuat pengembalian untuk peminjaman #{$peminjaman->id}");

            // update STATUS saja (tanpa tanggal)
            $peminjaman->update([
                'status' => 'dikembalikan'
            ]);

            // Log perubahan status peminjaman
            $this->logUpdate('Peminjaman', Peminjaman::class, $peminjaman->id, 
                ['status' => 'dipinjam'], 
                ['status' => 'dikembalikan'], 
                "Status peminjaman #{$peminjaman->id} diubah menjadi dikembalikan");

            // stok kembali kalau tidak hilang
            if ($request->kondisi !== 'hilang') {
                $peminjaman->alat->increment(
                    'jumlah_alat',
                    $peminjaman->jumlah_pinjam
                );

                $this->logActivity('update', 'Alat', 
                    "Stok alat {$peminjaman->alat->nama_alat} bertambah {$peminjaman->jumlah_pinjam} unit",
                    Alat::class, $peminjaman->alat->id);
            }
        });

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Pengembalian berhasil diproses');
    }
}
