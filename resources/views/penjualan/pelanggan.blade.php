@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Daftar pelanggan</h4>

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
                            <a href="{{ route('penjualan.create', $p->id_pelanggan) }}" class="btn btn-info">pilih</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pelanggan->links() }}
    </div>
</div>


@endsection
