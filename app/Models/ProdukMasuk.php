<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukMasuk extends Model
{
    use HasFactory;

    protected $guarded =[];

    // relasi ke produk
    public function produk(){
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
