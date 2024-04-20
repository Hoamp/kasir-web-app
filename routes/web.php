<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukMasukController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// sudah login
Route::middleware(['auth'])->group(function(){
    // home
    Route::get('/', function () { return redirect()->route('home'); });
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // ------- Start Halaman Admin -------

    Route::middleware(['is_admin'])->group(function(){
        //  pengguna / user
        Route::get('pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
        Route::get('pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::post('pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
        Route::post('pengguna/reset/{id}', [PenggunaController::class, 'reset'])->name('pengguna.reset');
        Route::delete('pengguna/{id}', [PenggunaController::class, 'delete'])->name('pengguna.delete');
        Route::get('pengguna/{id}', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::put('pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');

        // produk
        Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::delete('produk/{id}', [ProdukController::class, 'delete'])->name('produk.delete');
        Route::get('produk/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::put('produk/{id}', [ProdukController::class, 'update'])->name('produk.update');

        // produk masuk
        Route::get('produk-masuk', [ProdukMasukController::class, 'index'])->name('produk.masuk.index');
        Route::get('produk-masuk/create', [ProdukMasukController::class, 'create'])->name('produk.masuk.create');
        Route::post('produk-masuk', [ProdukMasukController::class, 'store'])->name('produk.masuk.store');
        Route::delete('produk-masuk/{id}', [ProdukMasukController::class, 'delete'])->name('produk.masuk.delete');

        // laporan penjualan
        Route::get('laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan.penjualan.index');
        Route::post('laporan-penjualan/cetak', [LaporanPenjualanController::class, 'cetak'])->name('laporan.penjualan.cetak');

    });

    // ------- End Halaman Admin -------

    // ------- Start Halaman Kasir -------

    Route::middleware(['is_kasir'])->group(function(){
        // pelanggan
        Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
        Route::get('pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
        Route::post('pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
        Route::delete('pelanggan/{id}', [PelangganController::class, 'delete'])->name('pelanggan.delete');
        Route::get('pelanggan/{id}', [PelangganController::class, 'edit'])->name('pelanggan.edit');
        Route::put('pelanggan/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');

        // penjualan
        Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('penjualan/pelanggan', [PenjualanController::class, 'pelanggan'])->name('penjualan.pelanggan');
        Route::get('penjualan/create/{id}', [PenjualanController::class, 'create'])->name('penjualan.create');
        Route::get('penjualan/edit/{kode_penjualan}', [PenjualanController::class, 'edit'])->name('penjualan.edit');
        Route::post('penjualan/bayar/{kode_penjualan}', [PenjualanController::class, 'bayar'])->name('penjualan.bayar');


        // detail penjualan
        Route::post('penjualan/detail/create', [DetailPenjualanController::class, 'create'])->name('penjualan.detail.create');
        Route::get('penjualan/detail/delete/{id}', [DetailPenjualanController::class, 'delete'])->name('penjualan.detail.delete');
    });

    // ------- End Halaman Kasir -------

    // ALL USER start
    Route::get('penjualan/invoice/{kode_penjualan}', [PenjualanController::class, 'invoice'])->name('penjualan.invoice');
    Route::get('penjualan/invoice/cetak/{kode_penjualan}', [PenjualanController::class, 'invoice_cetak'])->name('penjualan.invoice.cetak');
    // ALL USER done


    // logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// belum login
Route::middleware(['guest'])->group(function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
});
