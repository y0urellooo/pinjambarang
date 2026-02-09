<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = User::where('role', 'peminjam')->get();
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

        return back()->with('success', 'Status peminjam berhasil diubah');
    }
}
