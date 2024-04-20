@extends('layouts.main')


@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Daftar penjualan</h4>
        <form action="" >

            <div class="row">
                <div class="col-md-6">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Tanggal Awal</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col-md-6">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-2">Mulai</button>
        </form>

        @if ($start_date !== null)
            <form action="{{ route('laporan.penjualan.cetak') }}" method="POST">
                @csrf
                <input type="hidden" name="start_date" value="{{ isset($start_date) ? $start_date : '' }}">
                <input type="hidden" name="end_date" value="{{ isset($end_date) ? $end_date : '' }}">
                <button  class="btn btn-info my-2" type="submit">Cetak</button>
            </form>
        @endif

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

