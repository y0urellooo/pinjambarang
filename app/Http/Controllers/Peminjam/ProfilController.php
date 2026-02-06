<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function edit()
    {
        return view('peminjam.profile.edit-profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'           => 'required',
            'no_telpon'      => 'required',
            'alamat'         => 'required',
            'jenis_kelamin'  => 'required',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_peminjam'), $foto);
            $user->foto = $foto;
        }

        $user->update([
            'name'          => $request->name,
            'no_telpon'     => $request->no_telpon,
            'alamat'        => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('peminjam.profile')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
