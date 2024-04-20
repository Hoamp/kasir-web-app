<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function create(Request $request){
        // buat sub total dan ambil kode penjualan di penjualan
        $sub_total = $request->jumlah * $request->harga;
        $penjualan = Penjualan::where('kode_penjualan', $request->kode_penjualan)->first();

        // cek apakah produk yang masuk itu saman
        $detailCek = DetailPenjualan::where('kode_penjualan', $request->kode_penjualan)
                                      ->where('id_produk', $request->id_produk)->first();

        // jika ada
        if($detailCek){
            // update tanpa menambah field
            $penjualanD = $detailCek->update([
                'jumlah' => $detailCek->jumlah + $request->jumlah,
                'sub_total' => $detailCek->sub_total + $sub_total
            ]);

        }else{ // jika tidak
            // tambah row baru
            $penjualanD = DetailPenjualan::create([
                'kode_penjualan' => $request->kode_penjualan,
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
                'sub_total' => $sub_total,
            ]);
        }


        // update total harganya
        $penjualan->update([
            'total_harga' => $penjualan->total_harga + $sub_total
        ]);

        // sudah selesai
        return redirect()->route('penjualan.edit', $request->kode_penjualan);
    }

    public function delete($id){
        // ambil id detail penjualan dan penjualan yang selaras
        $detailP = DetailPenjualan::find($id);
        $penjualanKode = Penjualan::where('kode_penjualan', $detailP->kode_penjualan)
                                    ->first();

        // update terlebih dahulu total harganya
        $penjualanKode->update([
            'total_harga' => $penjualanKode->total_harga - $detailP->sub_total
        ]);

        // baru delete isinya detail
        $detailP->delete();

        // jika sudah arahkan kembali
        return redirect()->route('penjualan.edit', $penjualanKode->kode_penjualan);
    }
}
