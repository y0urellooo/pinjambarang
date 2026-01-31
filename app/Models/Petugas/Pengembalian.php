<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalians';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_dikembalikan',
        'kondisi',
        'catatan',
    ];

    // 🔗 Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(\App\Models\Petugas\Peminjaman::class);
    }
}
