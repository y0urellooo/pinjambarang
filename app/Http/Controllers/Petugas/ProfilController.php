<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function show()
    {
        return view('petugas.profile.profile');
    }

    public function edit()
    {
        return view('petugas.profile.edit-profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Siapkan data yang akan diupdate
        $data = [
            'name' => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        // Jika ada file foto, simpan dan tambahkan ke data
        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_petugas'), $foto);
            $data['foto'] = $foto;
        }

        // Update user sekaligus
        $user->update($data);

        logAktivitas(
            'Profil',
            'Petugas memperbarui profil'
        );

        return redirect()->route('petugas.profile.show')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
