@extends('layouts.main')

@section('content')
<div class="row">
    <h4>Kode penjualan {{ $kode_penjualan }}</h4>
    {{-- produk + pembayaran --}}
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">pilih produk</h4>

                <form action="" class="row my-2">
                    <div class="col-md-3">
                        <p>Produk</p>
                    </div>
                    <div class="col-md-7">
                        <select name="id_produk" id="" class="form-control">
                            @foreach ($produk as $p)
                            <option value="{{ $p->id_produk }}">{{ $p->kode_produk }} || {{ $p->nama }} || Stok : {{ $p->stok }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Pilih</button>
                    </div>
                </form>

                <form action="{{ route('penjualan.detail.create') }}" method="post">
                    @csrf
                    <div class="row my-2">
                        <div class="col-md-3">
                            <p>Nama</p>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" readonly value="{{ isset($dp) ? $dp->nama : 0 }}">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-3">
                            <p>Harga</p>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control harga" readonly value="{{ isset($dp) ? $dp->harga : '' }}" name="harga">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-3">
                            <p>Stok</p>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control" readonly value="{{ isset($dp) ? $dp->stok : '' }}">
                        </div>
                    </div>

                    @if (isset($dp))
                    <div class="row my-2">
                        <div class="col-md-3">
                            <p>Jumlah</p>
                        </div>
                        <div class="col-md-9">
                            <input type="number" class="form-control jumlah" min="1" max="{{ isset($dp) ? $dp->stok : 0 }}" name="jumlah" onkeyup="subtot()">
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <p>Subtotal : <span class="subt"></span></p>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-3">
                            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-info">Tambah</button>
                        </div>
                    </div>
                    <input type="hidden" name="id_produk" value="{{  isset($dp) ? $dp->id_produk : 0  }}">
                    <input type="hidden" name="kode_penjualan" value="{{ $kode_penjualan }}">
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Finalisasi Transaksi</h4>
                @if (session()->has('gagal_bayar'))
                <div class="alert alert-danger">{{ session('gagal_bayar') }}</div>
                @endif
                <form action="{{ route('penjualan.bayar', $kode_penjualan) }}" method="POST">

                    @csrf
                    <div class="mb-2">
                        <label for="">Total harga</label>
                    <input type="number" class="form-control" readonly value="{{ ($penjualan->total_harga > 0) ? $penjualan->total_harga : 0 }}">
                    </div>
                    @if ($penjualan->total_harga > 0 && $penjualan->bayar <= 0)
                        <div class="mb-2">
                            <label for="">Bayar</label>
                            <input type="number" class="form-control" name="bayar" min="{{ ($penjualan->total_harga > 0) ? $penjualan->total_harga : 0 }}">
                        </div>

                        <div class="mb-2 row justify-content-center my-2">
                            <button class="btn btn-info col-md-11">Bayar</button>
                        </div>
                    @endif
                    @if ($penjualan->bayar > 0)
                        <div class="mb-2">
                            <label for="">Bayar</label>
                            <input type="number" class="form-control" name="bayar" value="{{ $penjualan->bayar }}" readonly>
                        </div>
                        <div class="mb-2">
                            <label for="">Kembalian</label>
                            <input type="number" class="form-control" readonly value="{{ ($penjualan->bayar > 0) ? $penjualan->bayar - $penjualan->total_harga : 0 }}">
                        </div>
                        <a href="{{ route('penjualan.invoice', $kode_penjualan) }}" class="col-md-12 btn btn-primary">Invoice</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- untuk list produk --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4>List Produk</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>no</td>
                            <td>nama</td>
                            <td>jumlah</td>
                            <td>sub total</td>
                            <td>aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($d_penjualan as $d_penj)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d_penj->produk->nama }}</td>
                            <td>{{ $d_penj->jumlah }}</td>
                            <td>Rp. {{ number_format($d_penj->sub_total, '2', '.') }}</td>
                            <td>
                                <a href="{{ route('penjualan.detail.delete', $d_penj) }}">X</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5"><div class="alert alert-secondary">Belum ada produk</div></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    let harga = document.querySelector('.harga')
    let subt = document.querySelector('.subt')
    let jumlah = document.querySelector('.jumlah')

    function subtot(){
        let sub = jumlah.value * harga.value;
        subt.innerHTML = sub
    }
</script>
@endsection
