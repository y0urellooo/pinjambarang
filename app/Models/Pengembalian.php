<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali_aktual',
        'kondisi',
        'catatan',
        'denda',
        'status_bayar'
    ];

    public function peminjaman() {
        return $this->belongsTo(Peminjaman::class);
    }
}
