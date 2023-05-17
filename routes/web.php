<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\MetodePembayaranController;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;

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


Route::get('/', [Controller::class, 'index2'])->name('frontend.dashboard-pembeli-1');
Auth::routes();



Route::middleware(['auth','isPembeli'])->group( function() {
    Route::get('/home', [HomeController::class, 'index'])->name('frontend.dashboard-pembeli');
    Route::get('/produk/cari', [HomeController::class, 'cariProduk']);
    Route::get('/list-produk', [HomeController::class, 'produk'])->name('pembeli.viewproduk');
    Route::get('/list-produk/cari', [HomeController::class, 'cariProduk2']);
    Route::get('/detail-produk/{id}', [HomeController::class, 'detail_produk'])->name('pembeli.detailproduk');
    Route::get('/produk/{id}', [HomeController::class, 'produk_kategori'])->name('pembeli.viewprodukid');
    Route::get('/items', [ProdukController::class, 'sorting'])->name('items.index');
    Route::post('/produk/tambah-keranjang/{id}',[PesananController::class, 'keranjang'])->name('pembeli.tambahkeranjang');
    Route::get('/keranjang',[PesananController::class, 'vkeranjang'])->name('pembeli.keranjang');
    Route::get('/hapus/pesanan-keranjang/{id}', [PesananController::class, 'hapuskeranjang'])->name('admin.hapuspesanan');
    // update quantity di cart
    Route::post('/update-to-cart', [PesananController::class, 'updatetocart'])->name('cart.update');

    Route::get('/profile', [UserController::class,'vprofile'])->name('pembeli.profile');
    Route::post('/profile/update',[UserController::class, 'uprofile'])->name('pembeli.updateprofile');

    Route::get('/checkout', [PesananController::class,'vcheckout'])->name('pembeli.checkout');
    Route::post('/proses-checkout', [PesananController::class,'pcheckout'])->name('pembeli.pcheckout');

    Route::get('/pesanan', [PesananController::class,'vpesanan'])->name('pembeli.pesanan');
    Route::get('/detail-pesanan/{id}', [PesananController::class,'detail_pesanan'])->name('pembeli.detailpesanan');

    Route::get('get-metpem', [MetodePembayaranController::class, 'metpem'])->name('getMetpem');
    Route::get('get-layanan', [MetodePembayaranController::class, 'layanan'])->name('getLayanan');

    Route::get('/get-diproses', [PesananController::class, 'diproses'])->name('getDiproses');
    Route::get('/get-ditangguhkan', [PesananController::class, 'ditangguhkan'])->name('getDitangguhkan');
    Route::get('/get-belum', [PesananController::class, 'belumDiambil'])->name('getBelum');
    Route::get('/get-selesai', [PesananController::class, 'selesai'])->name('getSelesai');
});

Route::middleware(['auth', 'isAdmin'])->group( function() {
    Route::get('/dashboard-admin',[HomeController::class, 'dashboard'])->name('frontend.dashboard-admin');

    Route::get('/laporan',[PesananController::class, 'laporanpenjualan'])->name('admin.laporanpenjualan');
    Route::get('/get-penjualan', [PesananController::class, 'lPenjualan'])->name('getPenjualan');

    Route::get('/produks', [ProdukController::class, 'produk'])->name('admin.kelolaproduk');
    Route::get('/tambahproduk', [ProdukController::class,'viewtambahproduk'])->name('admin.tambahproduk');
    Route::post('/prosestambahproduk', [ProdukController::class,'tambahproduk'])->name('admin.storeproduk');
    Route::get('/ubahproduk/{id}', [ProdukController::class,'viewubahproduk'])->name('admin.ubahproduk');
    Route::post('/prosesubahproduk/{id}', [ProdukController::class,'ubahproduk'])->name('admin.updateproduk');
    Route::get('/prosesubahstatusproduk/nonaktif/{id}', [ProdukController::class,'ubahstatusproduknon'])->name('admin.updatestatusproduknon');
    Route::get('/produks/non-aktif', [ProdukController::class, 'produknonaktif'])->name('admin.kelolaproduknonaktif');
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
    // add import file
    Route::get('/tambahpengguna/import', [UserController::class, 'viewimport']);
    Route::post('/prosestambahpengguna/import', [UserController::class, 'import'])->name('tambahpengguna.import');
    Route::get('/tambahproduk/import', [ProdukController::class, 'viewImportProduct']);
    Route::post('/prosestambahproduk/import', [ProdukController::class, 'importProduk'])->name('tambahproduk.import');

    // end import file
    Route::get('/kelola-metode-pembayaran', [MetodePembayaranController::class, 'kemetpem'])->name('admin.kelolametodepembayaran');
    Route::get('/tambah-metode-pembayaran', [MetodePembayaranController::class,'tametpem'])->name('admin.tambahmetodepembayaran');
    Route::post('/prosestambahmetodepembayaran', [MetodePembayaranController::class,'tambahmetpem'])->name('admin.storemetodepembayaran');
    Route::get('/ubah-metode-pembayaran/{id}', [MetodePembayaranController::class,'ubmetpem'])->name('admin.ubahmetodepembayaran');
    Route::post('/prosesubahmetodepembayaran/{id}', [MetodePembayaranController::class,'ubahmetpem'])->name('admin.updatemetodepembayaran');
    Route::post('/prosestambahkategoripembayaran', [MetodePembayaranController::class,'tambahkapem'])->name('admin.storekategoripembayaran');
    Route::get('/hapus/kategoripembayaran/{id}', [MetodePembayaranController::class, 'hapuskapem'])->name('admin.hapuskategoripengguna');
    Route::get('/ubah-kategori-pembayaran/{id}', [MetodePembayaranController::class,'ubkapem'])->name('admin.ubahkategoripembayaran');
    Route::post('/proses-ubah-kategori-pembayaran/{id}', [MetodePembayaranController::class,'ubahkapem'])->name('admin.prosesubahkategoripembayaran');

    Route::get('/kelola-pesanan', [PesananController::class,'kelolapesanan'])->name('admin.kelolapesanan');
    Route::get('/detail/pesanan/{id}', [PesananController::class,'detailpesanan'])->name('admin.detailpesanan');
    Route::get('/ubah/status/{id}', [PesananController::class,'ubahstatus'])->name('admin.ubahstatus');
    Route::post('/proses/ubah/status/{id}', [PesananController::class,'updatestatus'])->name('admin.updatestatus');
    Route::get('/proses/ubah/status/batalkan/{id}', [PesananController::class,'updatebatalkan'])->name('admin.updatebatalkan');
});

Route::middleware(['auth', 'isPegawai'])->group( function() {
    Route::get('/dashboard-pegawai', function () {
        return view('frontend.dashboard-pegawai');
    });


});
