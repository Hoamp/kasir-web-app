<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index(){
        // halaman user
        $pengguna = User::latest()->paginate(5);

        return view('pengguna.index', compact('pengguna'));
    }

    public function create(){
        // halaman create user
        return view('pengguna.create');
    }

    public function store(Request $request){
        // validasi user
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'level' => 'required',
        ]);

        // create new user
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'sukses menambah pengguna');
    }

    public function reset($id){
        // reset password user
        $pengguna = User::find($id);
        $pengguna->update([
            'password' => bcrypt('123')
        ]);

        return redirect()->route('pengguna.index')->with('success', 'sukses reset password pengguna');
    }

    public function delete($id){
        // menghapus user
        $pengguna = User::find($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'sukses menghapus pengguna');
    }

    public function edit($id){
        // halaman edit user
        $pengguna = User::find($id);

        return view('pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, $id){
        // halaman update user

        // validasi
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'level' => 'required',
        ]);

        // cari user
        $pengguna = User::find($id);

        // jika password kosong maka jangan update password
        if($request->password == null){
            $pengguna->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'level' => $request->level,
            ]);
        } else {
            // jika ada password maka update password
            $pengguna->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'level' => $request->level,
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('pengguna.index')->with('success', 'sukses mengedit pengguna');
    }
}
