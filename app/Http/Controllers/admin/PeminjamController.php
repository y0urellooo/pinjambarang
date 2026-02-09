<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = User::where('role', 'peminjam')->latest()->paginate(8);
        return view('admin.peminjam.index', compact('peminjams'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Pastikan hanya peminjam
        if ($user->role !== 'peminjam') {
            return back()->with('error', 'Hanya peminjam yang bisa diubah statusnya');
        }

        $user->status = $user->status === 'active' ? 'nonactive' : 'active';
        $user->save();

        // log aktivitas
        logAktivitas('Peminjam', 'Mengubah status peminjam: ' . $user->name);

        $statusBaru = $user->status === 'active' ? 'Aktif' : 'Nonaktif';

        logAktivitas('Peminjam', 'Mengubah status ' . $user->name . ' menjadi ' . $statusBaru);

        return back()->with('success', 'Status peminjam berhasil diubah');
    }
}
