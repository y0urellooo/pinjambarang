<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alats = Alat::with('kategoris')->latest()->paginate(8);
        return view('admin.alat.index', compact('alats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_alat' => 'required|string|max:255',
            'kategori' => 'required|array|min:1',
            'kategori.*' => 'required|exists:kategoris,id',
            'jumlah_alat' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
        ], [
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpg, jpeg, atau png',
            'foto.max' => 'Ukuran gambar maksimal 2MB',

            'nama_alat.required' => 'Nama alat wajib diisi',

            'kategori.required' => 'Kategori wajib dipilih',
            'kategori.array' => 'Kategori tidak valid',
            'kategori.*.exists' => 'Kategori tidak ditemukan',

            'jumlah_alat.required' => 'Jumlah alat wajib diisi',
            'jumlah_alat.integer' => 'Jumlah alat harus berupa angka',
            'jumlah_alat.min' => 'Jumlah alat tidak boleh kurang dari 0',

            'deskripsi.required' => 'Deskripsi wajib diisi',
        ]);

        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_alat'), $foto);
        }

        $alat = Alat::create([
            'nama_alat' => $request->nama_alat,
            'jumlah_alat' => $request->jumlah_alat,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto ?? null,
        ]);

        // SIMPAN KATEGORI
        $alat->kategoris()->attach($request->kategori);

        logAktivitas('Alat', 'Menambahkan alat: ' . $alat->nama_alat);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('admin.alat.edit', compact('kategoris', 'alat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_alat' => 'required|string|max:255',
            'kategori' => 'required|array|min:1',
            'kategori.*' => 'required|exists:kategoris,id',
            'jumlah_alat' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ], [
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpg, jpeg, atau png',
            'foto.max' => 'Ukuran gambar maksimal 2MB',

            'nama_alat.required' => 'Nama alat wajib diisi',

            'kategori.required' => 'Kategori wajib dipilih',
            'kategori.array' => 'Kategori tidak valid',
            'kategori.*.exists' => 'Kategori tidak ditemukan',

            'jumlah_alat.required' => 'Jumlah alat wajib diisi',
            'jumlah_alat.integer' => 'Jumlah alat harus berupa angka',
            'jumlah_alat.min' => 'Jumlah alat tidak boleh kurang dari 0',
        ]);

        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_alat'), $foto);
            $alat->foto = $foto;
        }

        $alat->update([
            'nama_alat' => $request->nama_alat,
            'jumlah_alat' => $request->jumlah_alat,
            'deskripsi' => $request->deskripsi,
        ]);

        // UPDATE KATEGORI
        $alat->kategoris()->sync($request->kategori);

        logAktivitas('Alat', 'Mengupdate alat: ' . $alat->nama_alat);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {
        // CEK APAKAH ALAT SUDAH / SEDANG DIPINJAM
        if ($alat->peminjaman()->exists()) {
            return redirect()->route('admin.alat.index')
                ->with('error', 'Alat tidak bisa dihapus karena masih digunakan dalam peminjaman');
        }

        $nama = $alat->nama_alat;

        // hapus relasi kategori (biar rapi)
        $alat->kategoris()->detach();

        $alat->delete();

        logAktivitas('Alat', 'Menghapus alat: ' . $nama);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}
