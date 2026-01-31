<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index() {
        $alats = Alat::with('kategori')
        ->orderBy('nama_alat', 'asc')
        ->get();

        return view('peminjam.alat.index', compact('alats'));
    }
}
