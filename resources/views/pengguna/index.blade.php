@extends('layouts.main')


@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Daftar Pengguna</h4>

        <a href="{{ route('pengguna.create') }}" class="btn btn-primary mb-3">Tambah Pengguna</a>
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <table class="table table-hover mb-2">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Username</td>
                    <td>Level</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengguna as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->username }}</td>
                        <td>{{ $p->level }}</td>
                        <td>
                            <a href="{{ route('pengguna.edit', $p->id_user) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('pengguna.reset', $p->id_user) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-secondary" onclick="return confirm('yakin reset?')">Reset</button>
                            </form>
                            <form action="{{ route('pengguna.delete', $p->id_user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('yakin hapus?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pengguna->links() }}
    </div>
</div>

@endsection
