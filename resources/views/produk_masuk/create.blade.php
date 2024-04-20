@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah produk masuk</h4>

        <form action="{{ route('produk.masuk.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label for="">Produk</label>
                <select name="id_produk" id="" class="form-control">
                    @foreach ($produk as $p)
                        <option value="{{ $p->id_produk }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label for="">jumlah</label>
                <input type="number" name="jumlah" class="form-control" placeholder="masukkan jumlah" min="1">
                @error('jumlah')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <a href="{{ route('produk.masuk.index') }}" type="submit" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</div>
@endsection

