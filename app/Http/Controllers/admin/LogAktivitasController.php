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
            ->when($request->role, function($query, $role) {
                $query->where('role', $role);
            })
            ->when($request->modul, function($query, $modul) {
                $query->where('modul', 'like', "%{$modul}%");
            })
            ->when($request->aktivitas, function($query, $aktivitas) {
                $query->where('aktivitas', 'like', "%{$aktivitas}%");
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('admin.log.index', compact('logs'));
    }
}
