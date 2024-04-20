<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laporan penjualan</title>
</head>
<body>
    <center>
        <h1>laporan penjualan</h1>
        <table border="1" width="400px">
            <thead>
                <tr>
                    <td align="center">No</td>
                    <td align="center">Kode Penjualan</td>
                    <td align="center">Tanggal</td>
                    <td align="center">Total Harga</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->kode_penjualan }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td align="right">Rp. {{ number_format($p->total_harga, '2', '.'); }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">Rp. {{ $penjualanTotal }}</td>
                </tr>
            </tfoot>
        </table>
    </center>
</body>
</html>
