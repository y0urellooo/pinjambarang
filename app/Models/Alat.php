<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alats';

    protected $fillable = [
        'foto',
        'nama_alat',
        'jumlah_alat',
        'deskripsi'
    ];

    // MANY TO MANY
    public function kategoris()
    {
        return $this->belongsToMany(
            Kategori::class,
            'alat_kategori',
            'alat_id',
            'kategori_id'
        );
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
