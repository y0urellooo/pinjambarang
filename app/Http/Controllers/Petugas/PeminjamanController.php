<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan semua data peminjaman
     */
    public function index()
    {
        $peminjaman = Peminjaman::all(); // ambil semua data
        return view('petugas.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Tampilkan form untuk membuat peminjaman baru
     */
    public function create()
    {
        return view('petugas.peminjaman.create');
    }

    /**
     * Simpan data peminjaman baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'barang' => 'required|string',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        Peminjaman::create([
            'nama' => $request->nama,
            'barang' => $request->barang,
            'status' => 'pending', // default status
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dibuat');
    }

    /**
     * Tampilkan detail peminjaman
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    /**
     * Tampilkan form edit peminjaman
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('petugas.peminjaman.edit', compact('peminjaman'));
    }

    /**
     * Update data peminjaman
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'barang' => 'required|string',
            // validasi lain
        ]);

        $peminjaman->update([
            'nama' => $request->nama,
            'barang' => $request->barang,
            'status' => $request->status ?? $peminjaman->status,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diupdate');
    }

    /**
     * Hapus peminjaman
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus');
    }

    /**
     * Setujui peminjaman
     */
    public function setujui($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'disetujui';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman disetujui');
    }

    /**
     * Tolak peminjaman
     */
    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = 'ditolak';
        $peminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman ditolak');
    }
}
