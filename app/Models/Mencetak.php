<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mencetak extends Model
{
    use HasFactory;

    /**
     * Nama tabel (WAJIB kalau nama tabel
     * tidak jamak otomatis dari Laravel)
     */
    protected $table = 'mencetak';

    /**
     * Primary key (kalau bukan `id`)
     */
    protected $primaryKey = 'id';

    /**
     * Auto increment
     */
    public $incrementing = true;

    /**
     * Tipe primary key
     */
    protected $keyType = 'int';

    /**
     * Timestamp (created_at & updated_at)
     * set false kalau tabel tidak punya
     */
    public $timestamps = true;

    /**
     * Kolom yang boleh diisi (WAJIB untuk create/update)
     */
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
