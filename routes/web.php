<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [Controller::class, 'index2'])->name('frontend.dashboard-pembeli');
Auth::routes();



Route::middleware(['auth','isPembeli'])->group( function() {
    Route::get('/home', [HomeController::class, 'index'])->name('frontend.dashboard-pembeli');
    Route::get('/list-produk', [HomeController::class, 'produk'])->name('pembeli.viewproduk');
    Route::get('/detail-produk/{id}', [HomeController::class, 'detail_produk'])->name('pembeli.detailproduk');
    Route::get('/produk/{id}', [HomeController::class, 'produk_kategori'])->name('pembeli.viewprodukid');

    Route::post('/produk/tambah-keranjang/{id}',[PesananController::class, 'keranjang'])->name('pembeli.tambahkeranjang');
    Route::get('/keranjang',[PesananController::class, 'vkeranjang'])->name('pembeli.keranjang');
    Route::get('/hapus/pesanan-keranjang/{id}', [PesananController::class, 'hapuskeranjang'])->name('admin.hapuspesanan');

    Route::get('/profile', [UserController::class,'vprofile'])->name('pembeli.profile');
    Route::post('/profile/update',[UserController::class, 'uprofile'])->name('pembeli.updateprofile');
});

Route::middleware(['auth', 'isAdmin'])->group( function() {
    Route::get('/dashboard-admin', function () {
        return view('frontend.dashboard-admin');
    });

    Route::get('/produk', [ProdukController::class, 'produk'])->name('admin.kelolaproduk');
    Route::get('/tambahproduk', [ProdukController::class,'viewtambahproduk'])->name('admin.tambahproduk');
    Route::post('/prosestambahproduk', [ProdukController::class,'tambahproduk'])->name('admin.storeproduk');
    Route::get('/ubahproduk/{id}', [ProdukController::class,'viewubahproduk'])->name('admin.ubahproduk');
    Route::post('/prosesubahproduk/{id}', [ProdukController::class,'ubahproduk'])->name('admin.updateproduk');
    Route::get('/prosesubahstatusproduk/nonaktif/{id}', [ProdukController::class,'ubahstatusproduknon'])->name('admin.updatestatusproduknon');
    Route::get('/produk/non-aktif', [ProdukController::class, 'produknonaktif'])->name('admin.kelolaproduknonaktif');
    Route::get('/prosesubahstatusproduk/aktif/{id}', [ProdukController::class,'ubahstatusprodukaktf'])->name('admin.updatestatusprodukak');
    Route::get('/kategoriproduk', [KategoriController::class, 'kategoriproduk'])->name('admin.kelolakategoriproduk');
    Route::post('/prosestambahkategori', [KategoriController::class,'tambahkategori'])->name('admin.storekategori');
    Route::get('/ubahkategoriproduk/{id}', [KategoriController::class, 'ubahkategori'])->name('admin.ubahkategoriproduk');
    Route::post('/prosesubahkategori/{id}', [KategoriController::class,'prosesubahkategori'])->name('admin.ubahkategoripdk');
    Route::get('/hapuskategoriproduk/{id}', [KategoriController::class, 'hapuskategori'])->name('admin.hapuskategoriproduk');
    Route::get('/kelolapengguna', [UserController::class, 'user'])->name('admin.kelolapengguna');
    Route::get('/tambahpengguna', [UserController::class,'viewtambahuser'])->name('admin.tambahpengguna');
    Route::post('/prosestambahuser', [UserController::class,'tambahuser'])->name('admin.storepengguna');
    Route::get('/hapus/pengguna/{id}', [UserController::class, 'hapuspengguna'])->name('admin.hapuspengguna');
    Route::get('/ubahpengguna/{id}', [UserController::class,'viewubahuser'])->name('admin.ubahpengguna');
    Route::post('/updatepengguna/{id}', [UserController::class,'ubahpengguna'])->name('admin.updatepengguna');
});

Route::middleware(['auth', 'isPegawai'])->group( function() {
    Route::get('/dashboard-pegawai', function () {
        return view('frontend.dashboard-pegawai');
    });


});
