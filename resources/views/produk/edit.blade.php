@extends('layouts.main')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit produk</h4>

        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-2">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="masukkan nama" value="{{ $produk->nama }}">
                @error('nama')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">Kode Produk</label>
                <input type="text" name="kode_produk" class="form-control" placeholder="masukkan kode_produk"value="{{ $produk->kode_produk }}">
                @error('kode_produk')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">harga</label>
                <input type="number" name="harga" class="form-control" placeholder="masukkan harga"value="{{ $produk->harga }}">
                @error('harga')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label for="">stok</label>
                <input type="number" name="stok" class="form-control" placeholder="masukkan stok"value="{{ $produk->stok }}" min="1">
                @error('stok')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <a href="{{ route('produk.index') }}" type="submit" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">edit</button>
        </form>
    </div>
</div>
@endsection
