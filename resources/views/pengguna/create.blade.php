@extends('layouts.main')


@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Pengguna</h4>

        <form action="{{ route('pengguna.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="masukkan nama">
                @error('nama')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">username</label>
                <input type="text" name="username" class="form-control" placeholder="masukkan username">
                @error('username')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">password</label>
                <input type="password" name="password" class="form-control" placeholder="masukkan password">
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">level</label>
                <select name="level" id="" class="form-control">
                    <option value="kasir">kasir</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <a href="{{ route('pengguna.index') }}" type="submit" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>

@endsection
