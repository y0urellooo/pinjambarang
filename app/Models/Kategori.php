<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'nama_kategori',
    ];

    public function alats()
    {
        return $this->belongsToMany(
            Alat::class,
            'alat_kategori',
            'kategori_id',
            'alat_id'
        );
    }
}
