<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with([
            'peminjaman.alat',
            'peminjaman.user'
        ])
        ->latest('tanggal_kembali_aktual')
        ->paginate(8);

        return view('admin.pengembalian.index', compact('pengembalians'));
    }
}
