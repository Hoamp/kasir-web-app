@extends('layouts.main')


@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah pelanggan</h4>

        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="masukkan nama">
                @error('nama')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="masukkan alamat">
                @error('alamat')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">Telp</label>
                <input type="text" name="telp" class="form-control" placeholder="masukkan telp">
                @error('telp')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <a href="{{ route('pelanggan.index') }}" type="submit" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>

@endsection
