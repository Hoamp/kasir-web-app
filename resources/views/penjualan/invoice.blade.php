@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Invoice {{ $penjualan->kode_penjualan }}</h4>
        <small>Tanggal {{ $penjualan->kode_penjualan }}</small>

        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Data pelanggan</h5>
                <div class="row">
                    <div class="col-md-3">
                        <p>Nama</p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{ $penjualan->pelanggan->nama }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p>Alamat</p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{ $penjualan->pelanggan->alamat }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p>Telp</p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{ $penjualan->pelanggan->telp }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Data kasir</h5>
                <div class="row">
                    <div class="col-md-3">
                        <p>Nama</p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{ $penjualan->user->nama }}</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="my-3">
            <h5>Pembelian Produk</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Jumlah</td>
                        <td>Sub Total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailPenjualan as $dp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dp->produk->nama }}</td>
                            <td>{{ $dp->jumlah }}</td>
                            <td>Rp. {{ number_format($dp->sub_total, '2', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row my-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                        <p>Total Harga</p>
                    </div>
                    <div class="col-md-10">
                        <p>: Rp. {{ number_format($penjualan->total_harga, '2', '.') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p>Total Bayar</p>
                    </div>
                    <div class="col-md-10">
                        <p>: Rp. {{ number_format($penjualan->bayar, '2', '.') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p>Total Kembalian</p>
                    </div>
                    <div class="col-md-10">
                        <p>: Rp. {{ number_format($penjualan->bayar - $penjualan->total_harga, '2', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('penjualan.invoice.cetak', $penjualan->kode_penjualan) }}" class="btn btn-primary">Cetak</a>
    </div>
</div>
@endsection
