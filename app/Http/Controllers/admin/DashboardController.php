<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlat = Alat::count();
        $totalKategori = Kategori::count();

        $alatTersedia = Alat::where('jumlah_alat', '>', 0)->count();
        $alatHabis = Alat::where('jumlah_alat', 0)->count();

        return view('admin.dashboard', compact(
            'totalAlat',
            'totalKategori',
            'alatTersedia',
            'alatHabis'
        ));
    }
}
