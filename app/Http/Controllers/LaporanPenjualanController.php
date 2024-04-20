<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    public function index(){
        // jika ada inputan tanggal
        if(request('start_date')){
            //beri tanggalnya
            $penjualan = Penjualan::latest()->whereBetween('tanggal', [request('start_date'), request('end_date')])->where('bayar', '>', 0)->paginate(5);
        }else{ // jika tidak
            // beri default
            $penjualan = Penjualan::latest()->where('bayar', '>', 0)->paginate(5);
        }

        // ambil jika ada get variabel
        $start_date = request('start_date');
        $end_date = request('end_date');

        return view('laporan_penjualan.index', compact('penjualan', 'start_date', 'end_date'));
    }

    public function cetak(Request $request){
        // ambil request dan pilih yang cocok
        $penjualan = Penjualan::latest()->whereBetween('tanggal', [$request->start_date, $request->end_date])->where('bayar', '>', 0)->get();


        
        $penjualanTotal = number_format($penjualan->sum('total_harga'), '2', '.');


        return view('laporan_penjualan.laporan', compact('penjualan', 'penjualanTotal'));
    }
}
