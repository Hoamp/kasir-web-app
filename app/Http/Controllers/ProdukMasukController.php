<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukMasuk;
use Illuminate\Http\Request;

class ProdukMasukController extends Controller
{
    public function index(){
        //  halaman produk masuk
        $produkM = ProdukMasuk::with(['produk'])->latest()->paginate(5);

        return view('produk_masuk.index', compact('produkM'));
    }

    public function create(){
        // halaman tambah produk masuk
        $produk = Produk::all();
        return view('produk_masuk.create', compact('produk'));
    }

    public function store(Request $request){
        // tambah produk masuk
        $produk = Produk::find($request->id_produk);

        // tambah produk masuk dan tambah stoknya
        $produk->increment('stok', $request->jumlah);

        ProdukMasuk::create([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('produk.masuk.index')->with('success', 'sukses menambah stok produk');
    }

    public function delete($id){
        // delete produk
        $produkM = ProdukMasuk::find($id);

        // kembalikan produk yang telah diinputkan / fitur cancel add
        $produk = Produk::find($produkM->id_produk);
        $produk->decrement('stok', $produkM->jumlah);

        $produkM->delete();

        return redirect()->route('produk.masuk.index')->with('success', 'sukses menghapus stok produk');
    }
}
