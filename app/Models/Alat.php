<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{

    protected $table = 'alats';
    protected $fillable = [
        'foto',
        'nama_alat',
        'kategori_id',
        'jumlah_alat',
        'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
