@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row ">
            {{-- laporan sesuai hari dan bulan ini --}}
            <div class="col-md-3  " >
                <div class="rounded-3 shadow text-center p-2 ">
                    <h4>Penjualan hari ini</h4>
                    <p>{{ $penjualanHariIni->count() }}</p>
                </div>
            </div>
            <div class="col-md-3  " >
                <div class="rounded-3 shadow text-center p-2">
                    <h4>Penjualan bulan ini</h4>
                    <p>{{ $penjualanBulanIni->count() }}</p>
                </div>
            </div>
            <div class="col-md-3  " >
                <div class="rounded-3 shadow text-center p-2">
                    <h4>Pembayaran hari ini</h4>
                    <p>Rp. {{ number_format($penjualanHariIni->sum('bayar'), '2', '.') }}</p>
                </div>
            </div>
            <div class="col-md-3  " >
                <div class="rounded-3 shadow text-center p-2">
                    <h4>Pembayaran bulan ini</h4>
                    <p>Rp. {{ number_format($penjualanBulanIni->sum('bayar'), '2', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
