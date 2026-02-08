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
            'name'           => 'required',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_petugas'), $foto);
            $user->foto = $foto;
        }

        $user->update([
            'name'          => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('petugas.profile.show')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
