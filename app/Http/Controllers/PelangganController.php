<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){
        // ambil semua pelanggan
        $pelanggan = Pelanggan::latest()->paginate(5);

        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create(){
        // tampil halaman pelanggan
        return view('pelanggan.create');
    }

    public function store(Request $request){
        // validasi
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required'
        ]);

        // buat user baru
        Pelanggan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ]);

        // kembali dengan session
        return redirect()->route('pelanggan.index')->with('success', 'sukses menambah pelanggan');
    }

    public function delete($id){
        // hapus user
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'sukses menghapus pelanggan');
    }


    public function edit($id){
        // halaman edit user
        $pelanggan = Pelanggan::find($id);

        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id){
        // validasi
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required'
        ]);

        // cari pelanggan
        $pelanggan = Pelanggan::find($id);

        // lalu update
        $pelanggan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ]);


        return redirect()->route('pelanggan.index')->with('success', 'sukses mengedit pelanggan');
    }

}
