<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class MencetakController extends Controller
{
    // Halaman dashboard / daftar peminjaman
    public function index()
    {
        $mencetak = Peminjaman::all(); // ambil semua data, bisa ditambahkan paginate jika mau
        return view('petugas.mencetak.index', compact('mencetak'));
    }

    // Halaman khusus untuk cetak semua data
    public function cetak()
    {
        $mencetak = Peminjaman::all(); // ambil semua data
        return view('petugas.mencetak.laporan-print', compact('mencetak'));
    }
}
