@extends('layouts.main')


@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Daftar produk masuk</h4>

        <a href="{{ route('produk.masuk.create') }}" class="btn btn-primary mb-3">Tambah produk masuk</a>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <table class="table table-hover mb-2">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Kode Produk</td>
                    <td>Nama Produk</td>
                    <td>jumlah</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($produkM as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->produk->kode_produk }}</td>
                        <td>{{ $p->produk->nama }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>
                            <form action="{{ route('produk.masuk.delete', $p->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('yakin hapus?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $produkM->links() }}
    </div>
</div>

@endsection
