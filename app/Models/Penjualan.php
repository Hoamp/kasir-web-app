<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id_penjualan';

    // relasi ke pelanggan
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    // relasi ke user
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
