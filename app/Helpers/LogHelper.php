<?php

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

function logAktivitas($modul, $aktivitas)
{
    if (!Auth::check()) {
        return;
    }

    LogAktivitas::create([
        'nama_user' => Auth::user()->name,
        'role'      => Auth::user()->role,
        'modul'     => $modul,
        'aktivitas' => $aktivitas,
    ]);
}
