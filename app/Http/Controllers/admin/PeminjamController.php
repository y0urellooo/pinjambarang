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
}
