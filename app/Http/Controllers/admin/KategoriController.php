<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Traits\ActivitylogTrait;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    use ActivitylogTrait;

    public function index()
    {
        $this->logView('Kategori', 'Melihat daftar kategori');
        $kategoris = Kategori::latest()->paginate(8);
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:25|unique:kategoris',
        ],
        [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
            'nama_kategori.max' => 'Nama kategori maksimal 25 huruf'
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Log aktivitas
        $this->logCreate('Kategori', Kategori::class, $kategori->id, $kategori->toArray(), "Membuat kategori baru: {$kategori->nama_kategori}");

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|max:25|unique:kategoris,nama_kategori,' . $id,
        ]);

        $kategori = Kategori::findOrFail($id);
        $oldData = $kategori->toArray();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        // Log aktivitas
        $this->logUpdate('Kategori', Kategori::class, $kategori->id, $oldData, $kategori->toArray(), "Mengubah kategori: {$kategori->nama_kategori}");

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        if ($kategori->alats()->count() > 0) {
            return redirect()
                ->route('admin.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena digunakan oleh alat.');
        }

        $oldData = $kategori->toArray();
        $kategoriName = $kategori->nama_kategori;
        $kategori->delete();

        // Log aktivitas
        $this->logDelete('Kategori', Kategori::class, $kategori->id, $oldData, "Menghapus kategori: {$kategoriName}");

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
