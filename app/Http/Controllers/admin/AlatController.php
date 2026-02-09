<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Traits\ActivitylogTrait;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    use ActivitylogTrait;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->logView('Alat', 'Melihat daftar alat');
        $alats = Alat::latest()->paginate(8);
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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah_alat' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
        ], [
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpg, jpeg, atau png',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
            'nama_alat.required' => 'Nama alat wajib diisi',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'jumlah_alat.required' => 'Jumlah alat wajib diisi',
            'jumlah_alat.integer' => 'Jumlah alat harus berupa angka',
            'jumlah_alat.min' => 'Jumlah alat tidak boleh kurang dari 0',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'deskripsi.string' => 'Deskripsi harus berupa teks',
        ]);

        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_alat'), $foto);
            $validated['foto'] = $foto;
        }

        $alat = Alat::create($validated);

        // Log aktivitas
        $this->logCreate('Alat', Alat::class, $alat->id, $validated, "Membuat alat baru: {$alat->nama_alat}");

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
        $oldData = $alat->toArray();

        $validated = $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah_alat' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ], [
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpg, jpeg, atau png',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
            'nama_alat.required' => 'Nama alat wajib diisi',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'jumlah_alat.required' => 'Jumlah alat wajib diisi',
            'jumlah_alat.integer' => 'Jumlah alat harus berupa angka',
            'jumlah_alat.min' => 'Jumlah alat tidak boleh kurang dari 0',
            'deskripsi.string' => 'Deskripsi harus berupa teks',
        ]);

        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_alat'), $foto);
            $validated['foto'] = $foto;
        }

        $alat->update($validated);

        // Log aktivitas
        $this->logUpdate('Alat', Alat::class, $alat->id, $oldData, $validated, "Mengubah alat: {$alat->nama_alat}");
        
        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {
        $oldData = $alat->toArray();
        $alatName = $alat->nama_alat;
        
        $alat->delete();

        // Log aktivitas
        $this->logDelete('Alat', Alat::class, $alat->id, $oldData, "Menghapus alat: {$alatName}");
    }
}
