<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail';

    protected $guarded = [];

    // relasi produk
    public function produk(){
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
