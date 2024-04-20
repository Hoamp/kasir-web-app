<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
</head>
<body>
<h1>------- GW Mart -------</h1>
<h5>--------------------- Tanggal {{ $penjualan->tanggal }} --------------------- </h5>

<h4>Data pelanggan</h4>
<table>
    <tr>
        <td>Nama</td>
        <td>: {{ $penjualan->pelanggan->nama }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: {{ $penjualan->pelanggan->alamat }}</td>
    </tr>
    <tr>
        <td>Telp</td>
        <td>: {{ $penjualan->pelanggan->telp }}</td>
    </tr>
</table>
<h4 style="margin-top: 20px">Kasir yang melayani</h4>
<p>Nama : {{ $penjualan->user->nama }}</p>


<h4 style="margin-top: 20px">Pembelian</h4>
<table>
    <table  width="300px">
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
                    <td>{{ $dp->sub_total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</table>

<h4 style="margin-top: 30px">Pembayaran</h4>
<table >
    <tr>
        <td>Total harga</td>
        <td>: {{ $penjualan->total_harga }}</td>
    </tr>
    <tr>
        <td>Total bayar</td>
        <td>: {{  $penjualan->bayar  }}</td>
    </tr>
    <tr>
        <td>Total kembalian</td>
        <td>: {{ $penjualan->bayar -  $penjualan->total_harga  }}</td>
    </tr>
</table>

</body>
</html>
