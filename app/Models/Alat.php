<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $fillable = [
        'nama_alat',
        'kode_alat',
        'kategori_id',
        'jumlah_alat',
        'deskripsi',
    ];

    public function kategori ()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
