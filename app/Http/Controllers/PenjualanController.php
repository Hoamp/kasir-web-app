<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PenjualanController extends Controller
{
    public function index(){
        // tampilkan penjualan yang sudah selesai
        $penjualan = Penjualan::latest()->where('bayar', '>', 0)->paginate(5);

        return view('penjualan.index', compact('penjualan'));
    }

    public function pelanggan(){
        // halaman pilih pelanggan
        $pelanggan = Pelanggan::latest()->paginate(5);

        return view('penjualan.pelanggan', compact('pelanggan'));
    }

    public function create($id){
        //  ambil untuk nama nota baru
        $penjualanNew = Penjualan::latest()->first();

        // jika belum ada penjualan
        if($penjualanNew == null){
            $kp = 'NTK' . $id . 1 . 'GW';
            $penjualan = Penjualan::create([
                'kode_penjualan' => $kp,
                'tanggal' => Carbon::now()->toDateString(),
                'id_user' =>auth()->user()->id_user,
                'id_pelanggan' => $id
            ]);

            // jika sudah ada penjualan
        }else{
            $kp = 'NTK' . $id . $penjualanNew->id_penjualan + 1 . 'GW';
            $penjualan = Penjualan::create([
                'kode_penjualan' => $kp,
                'tanggal' => Carbon::now()->toDateString(),
                'id_user' =>auth()->user()->id_user,
                'id_pelanggan' => $id
            ]);
        }
        return redirect()->route('penjualan.edit', $penjualan->kode_penjualan);
    }

    public function edit($kode_penjualan){
        // halaman edit penjualan
        $produk = Produk::all();

        $dp =Produk::find(request('id_produk'));

        $d_penjualan = DetailPenjualan::with(['produk'])->where('kode_penjualan', $kode_penjualan)->get();

        $penjualan = Penjualan::where('kode_penjualan', $kode_penjualan)->first();

        return view('penjualan.edit', compact('produk', 'dp' , 'kode_penjualan', 'd_penjualan', 'penjualan'));
    }

    public function bayar(Request $request, $kode_penjualan){
        // halaman bayar
        $penjualan = Penjualan::where('kode_penjualan', $kode_penjualan)->first();

        $detailPenjualan = DetailPenjualan::with(['produk'])->where('kode_penjualan',$kode_penjualan)->get();

        /// jika stok produk habis
        foreach($detailPenjualan as $dp){
            if($dp->produk->stok < $dp->jumlah){
                return redirect()->route('penjualan.edit', $kode_penjualan)->with('gagal_bayar', 'stok ' . $dp->produk->nama . ' sudah habis. silahkan mulai transaksi lain');
            }
        }

        // jika aman dan bisa mengurangi stok produk
        foreach($detailPenjualan as $dp){
            $produk = Produk::find($dp->produk->id_produk);
            $produk->decrement('stok', $dp->jumlah);
        }

        // update bayar / transaksi selesai
        $penjualan->update([
            'bayar' => $request->bayar
        ]);

        return redirect()->route('penjualan.edit', $penjualan->kode_penjualan);
    }

    public function invoice($kode_penjualan){
        // nota pembelanjaan
        $penjualan = Penjualan::with(['pelanggan', 'user'])->where('kode_penjualan', $kode_penjualan)->first();

        $detailPenjualan = DetailPenjualan::with(['produk'])->where('kode_penjualan', $kode_penjualan)->get();

        return view('penjualan.invoice', compact('penjualan', 'detailPenjualan'));
    }

    public function invoice_cetak($kode_penjualan){
        // cetak untuk penjualan
        $penjualan = Penjualan::with(['pelanggan', 'user'])->where('kode_penjualan', $kode_penjualan)->first();

        $detailPenjualan = DetailPenjualan::with(['produk'])->where('kode_penjualan', $kode_penjualan)->get();

        return view('penjualan.invoice_cetak', compact('penjualan', 'detailPenjualan'));;
    }
}
