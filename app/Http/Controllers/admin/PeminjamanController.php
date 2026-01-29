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
        $alats = Alat::where('jumlah_alat', '>', 0)->get();

        return view('admin.peminjaman.create', compact('users', 'alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required|exists:users,id',
            'alat_id'        => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
        ],[
            'user_id.required' => 'Peminjam wajib dipilih.',
            'user_id.exists' => 'Peminjam tidak ditemukan.',
            'alat_id.required' => 'Alat wajib dipilih.',
            'alat_id.exists' => 'Alat tidak ditemukan.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_pinjam.date' => 'Tanggal pinjam tidak valid.',
        ]);

        DB::transaction(function () use ($request) {

            Peminjaman::create([
                'user_id'        => $request->user_id,
                'alat_id'        => $request->alat_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'status'         => 'dipinjam',
            ]);

            Alat::where('id', $request->alat_id)
                ->decrement('jumlah_alat', 1);
        });

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $alats = Alat::where('jumlah_alat', '>', 0)
            ->orWhere('id', $peminjaman->alat_id)
            ->get();

        return view('admin.peminjaman.edit', compact('peminjaman', 'alats'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'alat_id'        => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
        ],[
            'alat_id.required' => 'Alat wajib dipilih.',
            'alat_id.exists' => 'Alat tidak ditemukan.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_pinjam.date' => 'Tanggal pinjam tidak valid.',
        ]);

        DB::transaction(function () use ($request, $peminjaman) {

            // jika alat diganti, stok disesuaikan
            if ($peminjaman->alat_id != $request->alat_id) {
                $peminjaman->alat->increment('jumlah_alat');
                Alat::where('id', $request->alat_id)->decrement('jumlah_alat');
            }

            $peminjaman->update([
                'alat_id'        => $request->alat_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
            ]);
        });

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dikoreksi');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus');
    }
}
