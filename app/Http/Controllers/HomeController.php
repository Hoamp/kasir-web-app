<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index(){
        // mendapatkan penjualan hari ini
        $penjualanHariIni = Penjualan::where('tanggal', Carbon::now()->toDateString());

        // mendapatkan penjualan bulan ini
        $penjualanBulanIni = Penjualan::whereBetween('tanggal', [Carbon::now()->startOfMonth()->toDateString(), Carbon::now()->endOfMonth()->toDateString()])->get();
        return view('home', compact('penjualanHariIni', 'penjualanBulanIni'));
    }
}
