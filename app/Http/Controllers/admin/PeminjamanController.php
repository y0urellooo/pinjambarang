<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::all();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::where('status', 'tersedia')->get();

        return view('admin.peminjaman.create', compact('users', 'alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'alat_id'        => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'keterangan'     => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            Peminjaman::create([
                'user_id'        => $request->user_id,
                'alat_id'        => $request->alat_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'status'         => 'dipinjam',
                'keterangan'     => $request->keterangan,
            ]);

            Alat::where('id', $request->alat_id)
                ->update(['status' => 'dipinjam']);
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('admin.peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
            'status'          => 'required|in:dikembalikan,rusak,hilang',
        ]);

        DB::transaction(function () use ($request, $peminjaman) {

            $peminjaman->update([
                'tanggal_kembali' => $request->tanggal_kembali,
                'status'          => $request->status,
            ]);

            if ($request->status === 'dikembalikan') {
                $peminjaman->alat->update([
                    'status' => 'tersedia',
                ]);
            }
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus');
    }
}
