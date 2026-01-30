<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    // Sesuaikan dengan nama tabel yang ada di database kamu
    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id', 'tanggal_kembali', 'status'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
