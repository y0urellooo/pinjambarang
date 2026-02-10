<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index() {
        $alats = Alat::with('kategoris')
        ->orderBy('nama_alat', 'asc')
        ->paginate(8);

        return view('peminjam.alat.index', compact('alats'));
    }
}
