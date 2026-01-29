<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alats = Alat::all();
        return view('alats.index', compact('alats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alats.create');
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
            'kondisi'     => 'required|in:tersedia,dipinjam,rusak,perbaikan',
            'status'      => 'required|in:tersedia,dipinjam',
            'deskripsi'   => 'nullable|string',
        ]);

        Alat::create($validated);

        return redirect()->route('alats.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alat $alat)
    {
        return view('alats.show', compact('alat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alat $alat)
    {
        return view('alats.edit', compact('alat'));
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
            'kondisi'     => 'required|in:tersedia,dipinjam,rusak,perbaikan',
            'status'      => 'required|in:tersedia,dipinjam',
            'deskripsi'   => 'nullable|string',
        ]);

        $alat->update($validated);

        return redirect()->route('alats.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {
        $alat->delete();

        return redirect()->route('alats.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}
