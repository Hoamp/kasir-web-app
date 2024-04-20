<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(){
        // ambil semua produk
        $produk = Produk::latest()->paginate(5);

        return view('produk.index', compact('produk'));
    }

    public function create(){
        // halaman create produk
        return view('produk.create');
    }

    public function store(Request $request){
        // halaman menambah produk

        // validasi
        $request->validate([
            'nama' => 'required',
            'kode_produk' => 'required|unique:produks,kode_produk',
            'stok' => 'required',
            'harga' => 'required',
        ]);

        // tambah produk baru
        Produk::create([
            'nama' => $request->nama,
            'kode_produk' => $request->kode_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        return redirect()->route('produk.index')->with('success', 'sukses menambah produk');
    }

    public function delete($id){
        // hapus produk
        $produk = Produk::find($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'sukses menghapus produk');
    }

    public function edit($id){
        // halaman edit produk
        $produk = Produk::find($id);

        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id){
        // proses update produk
        $request->validate([
            'nama' => 'required',
            'kode_produk' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ]);

        //  cari produk lalu update
        $produk = Produk::find($id);

        $produk->update([
            'nama' => $request->nama,
            'kode_produk' => $request->kode_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ]);

        // redirect dengan pesan
        return redirect()->route('produk.index')->with('success', 'sukses mengedit produk');
    }
}
