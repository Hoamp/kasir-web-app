@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Daftar produk</h4>

        <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah produk</a>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <table class="table table-hover mb-2">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Kode Produk</td>
                    <td>Stok</td>
                    <td>Harga</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->kode_produk }}</td>
                        <td>{{ $p->stok }}</td>
                        <td>Rp. {{ number_format($p->harga, '2', '.') }}</td>
                        <td>
                            <a href="{{ route('produk.edit', $p->id_produk) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('produk.delete', $p->id_produk) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('yakin hapus?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $produk->links() }}
    </div>
</div>


@endsection
