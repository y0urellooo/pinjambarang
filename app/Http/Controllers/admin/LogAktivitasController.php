<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $logs = LogAktivitas::query()
            ->when($request->role, function ($query, $role) {
                $query->where('role', $role);
            })
            ->when($request->modul, function ($query, $modul) {
                $query->where('modul', $modul);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // urutkan
        $moduls = collect([
            'Dashboard',
            'Alat',
            'Kategori',
            'Peminjaman',
            'Pengembalian',
            'Laporan',
            'Petugas',
            'Profil Admin'
        ])->filter(
                fn($m) =>
                LogAktivitas::where('modul', $m)->exists()
            );

        return view('admin.log.index', compact('logs', 'moduls'));
    }
}
