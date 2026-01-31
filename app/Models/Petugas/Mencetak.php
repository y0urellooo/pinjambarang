<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mencetak extends Model
{
    use HasFactory;

    protected $table = 'mencetak';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'nama',
        'jenis',
        'jumlah',
        'keterangan',
        'tanggal_cetak'
    ];
    
    protected $hidden = [
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'tanggal_cetak' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Contoh relasi (opsional)
     * Jika mencetak dimiliki oleh user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
