<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'alat_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    // 🔗 Relasi ke User (peminjam)
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // 🔗 Relasi ke Alat
    public function alat()
    {
        return $this->belongsTo(\App\Models\Alat::class);
    }

    // 🔗 Relasi ke Pengembalian
    public function pengembalian()
    {
        return $this->hasOne(\App\Models\Petugas\Pengembalian::class);
    }
}
