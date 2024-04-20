@extends('layouts.main')


@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah produk</h4>

        <form action="{{ route('produk.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="masukkan nama">
                @error('nama')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">Kode Produk</label>
                <input type="text" name="kode_produk" class="form-control" placeholder="masukkan kode_produk">
                @error('kode_produk')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">harga</label>
                <input type="number" name="harga" class="form-control" placeholder="masukkan harga" min="1">
                @error('harga')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">stok</label>
                <input type="number" name="stok" class="form-control" placeholder="masukkan stok" min="1">
                @error('stok')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <a href="{{ route('produk.index') }}" type="submit" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>

@endsection
