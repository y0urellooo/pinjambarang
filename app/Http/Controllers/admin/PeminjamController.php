<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;

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

        // Log aktivitas aktif/nonaktif
        $action = $user->status === 'active' ? 'activate' : 'deactivate';
        ActivityLog::log($action, "Mengubah status peminjam: {$user->name} menjadi {$user->status}", 'User', User::class, $user->id);

        return back()->with('success', 'Status peminjam berhasil diubah');
    }
}
