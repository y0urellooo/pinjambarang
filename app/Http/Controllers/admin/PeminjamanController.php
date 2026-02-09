<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Traits\ActivitylogTrait;

class PeminjamanController extends Controller
{
    use ActivitylogTrait;

    public function index()
    {
        $this->logView('Peminjaman', 'Melihat daftar peminjaman');
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->paginate(8);

        return view('admin.peminjaman.index', compact('peminjamans'));
    }
}
