<?php

namespace App\Http\Controllers\admin;

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
        $alats = Alat::all();
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
        $validated = $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kode_alat'   => 'required|integer|unique:alats,kode_alat',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah_alat' => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
        ], [
            'nama_alat.required'   => 'Nama alat wajib diisi',
            'kode_alat.required'   => 'Kode alat wajib diisi',
            'kode_alat.integer'    => 'Kode alat harus berupa angka',
            'kode_alat.unique'     => 'Kode alat sudah digunakan',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists'   => 'Kategori tidak valid',
            'jumlah_alat.required' => 'Jumlah alat wajib diisi',
            'jumlah_alat.integer'  => 'Jumlah alat harus berupa angka',
            'jumlah_alat.min'      => 'Jumlah alat tidak boleh kurang dari 0',
            'deskripsi.string'     => 'Deskripsi harus berupa teks',
        ]);

        Alat::create($validated);

        return redirect()->route('alat.index')
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
        $validated = $request->validate([
            'nama_alat'   => 'required|string|max:255',
            'kode_alat'   => 'required|integer|unique:alats,kode_alat,' . $alat->id,
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah_alat' => 'required|integer|min:0',
            'deskripsi'   => 'nullable|string',
        ], [
            'nama_alat.required'   => 'Nama alat wajib diisi',
            'kode_alat.required'   => 'Kode alat wajib diisi',
            'kode_alat.integer'    => 'Kode alat harus berupa angka',
            'kode_alat.unique'     => 'Kode alat sudah digunakan',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists'   => 'Kategori tidak valid',
            'jumlah_alat.required' => 'Jumlah alat wajib diisi',
            'jumlah_alat.integer'  => 'Jumlah alat harus berupa angka',
            'jumlah_alat.min'      => 'Jumlah alat tidak boleh kurang dari 0',
            'deskripsi.string'     => 'Deskripsi harus berupa teks',
        ]);

        $alat->update($validated);

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {
        $alat->delete();

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}
