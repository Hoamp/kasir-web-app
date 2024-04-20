@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Daftar penjualan</h4>

        <a href="{{ route('penjualan.pelanggan') }}" class="btn btn-primary mb-3">Tambah penjualan</a>

        <table class="table table-hover mb-2">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Kode penjualan</td>
                    <td>Tanggal</td>
                    <td>Total Harga</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->kode_penjualan }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>Rp. {{ number_format($p->total_harga, '2', '.') }}</td>
                        <td>
                            <a href="{{ route('penjualan.invoice', $p->kode_penjualan ) }}" class="btn btn-primary">Invoice</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $penjualan->links() }}
    </div>
</div>
@endsection
