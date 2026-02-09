<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function show()
    {
        return view('admin.profile.profile');
    }

    public function edit()
    {
        return view('admin.profile.edit-profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name' => $request->name,
        ];

        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('foto_admin'), $foto);
            $data['foto'] = $foto;
        }

        $user->update($data);

        logAktivitas(
            'Profil Admin',
            'Memperbarui profil admin'
        );

        return redirect()->route('admin.profile.show')
            ->with('success', 'Profil admin berhasil diperbarui');
    }
}
