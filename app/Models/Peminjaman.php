<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
       protected $table = 'peminjaman';

       protected $fillable = [
        'user_id',
        'alat_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
       ];


       public function user() {
        return $this->belongsTo(User::class);
       }

       public function alat() {
        return $this->belongsTo(Alat::class);
       }

       public function pengembalian() {
        return $this->hasOne(Pengembalian::class);
       }
}
