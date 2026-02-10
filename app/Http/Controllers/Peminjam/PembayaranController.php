<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.alat')
            ->whereHas('peminjaman', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->where('denda', '>', 0)
            ->orderBy('tanggal_kembali_aktual', 'desc')
            ->paginate(8);

        return view('peminjam.pengembalian.index', compact('pengembalians'));
    }

    // bayar denda
    public function bayar(Pengembalian $pengembalian)
    {
        $user = auth()->user();

        // keamanan: pastikan milik user
        if ($pengembalian->peminjaman->user_id !== $user->id) {
            abort(403);
        }

        // sudah lunas
        if ($pengembalian->status_bayar === 'lunas') {
            return back()->with('info', 'Denda sudah dibayar sebelumnya');
        }

        // tidak ada denda
        if ($pengembalian->denda <= 0) {
            return back()->with('error', 'Tidak ada denda untuk dibayar');
        }

        DB::transaction(function () use ($pengembalian, $user) {

            // kurangi total denda user
            $user->decrement('total_denda', $pengembalian->denda);

            // update status bayar
            $pengembalian->update([
                'status_bayar' => 'lunas'
            ]);

            // log aktivitas
            logAktivitas(
                'Pembayaran',
                'Membayar denda pengembalian ID: ' . $pengembalian->id
            );
        });

        return redirect()
            ->route('peminjam.pengembalian.index')
            ->with('success', 'Denda berhasil dibayar');
    }
}
