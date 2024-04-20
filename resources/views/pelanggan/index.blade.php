@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Daftar pelanggan</h4>

        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah pelanggan</a>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <table class="table table-hover mb-2">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Alamat</td>
                    <td>Telp</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($pelanggan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->telp }}</td>
                        <td>
                            <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('pelanggan.delete', $p->id_pelanggan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('yakin hapus?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pelanggan->links() }}
    </div>
</div>


@endsection
