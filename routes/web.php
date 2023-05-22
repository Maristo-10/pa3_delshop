<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\MetodePembayaranController;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

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

//reset password

Route::get('/forgot-password', function () {

    return view('auth.forgot-password');
})->middleware('guest')->name('password-request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password-email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password-reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password-update');



Route::middleware(['auth', 'isPembeli'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('frontend.dashboard-pembeli');
    Route::get('/produk/cari', [HomeController::class, 'cariProduk']);
    Route::get('/list-produk', [HomeController::class, 'produk'])->name('pembeli.viewproduk');
    Route::get('/list-produk/cari', [HomeController::class, 'cariProduk2']);
    Route::get('/detail-produk/{id}', [HomeController::class, 'detail_produk'])->name('pembeli.detailproduk');
    Route::get('/produk/{id}', [HomeController::class, 'produk_kategori'])->name('pembeli.viewprodukid');
    Route::get('/items', [ProdukController::class, 'sorting'])->name('items.index');
    Route::post('/produk/tambah-keranjang/{id}', [PesananController::class, 'keranjang'])->name('pembeli.tambahkeranjang');
    Route::get('/keranjang', [PesananController::class, 'vkeranjang'])->name('pembeli.keranjang');
    Route::get('/hapus/pesanan-keranjang/{id}', [PesananController::class, 'hapuskeranjang'])->name('admin.hapuspesanan');
    // update quantity di cart
    Route::post('/update-to-cart', [PesananController::class, 'updatetocart'])->name('cart.update');

    Route::get('/profile', [UserController::class, 'vprofile'])->name('pembeli.profile');
    Route::post('/profile/update', [UserController::class, 'uprofile'])->name('pembeli.updateprofile');

    Route::get('/checkout', [PesananController::class, 'vcheckout'])->name('pembeli.checkout');
    Route::post('/proses-checkout', [PesananController::class, 'pcheckout'])->name('pembeli.pcheckout');

    Route::get('/pesanan', [PesananController::class, 'vpesanan'])->name('pembeli.pesanan');
    Route::get('/detail-pesanan/{id}', [PesananController::class, 'detail_pesanan'])->name('pembeli.detailpesanan');

    Route::get('get-metpem', [MetodePembayaranController::class, 'metpem'])->name('getMetpem');
    Route::get('get-layanan', [MetodePembayaranController::class, 'layanan'])->name('getLayanan');

    Route::get('/get-diproses', [PesananController::class, 'diproses'])->name('getDiproses');
    Route::get('/get-ditangguhkan', [PesananController::class, 'ditangguhkan'])->name('getDitangguhkan');
    Route::get('/get-belum', [PesananController::class, 'belumDiambil'])->name('getBelum');
    Route::get('/get-selesai', [PesananController::class, 'selesai'])->name('getSelesai');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard-admin', [HomeController::class, 'dashboard'])->name('frontend.dashboard-admin');

    Route::get('/laporan-custom', [PesananController::class, 'laporanpenjualanCustom'])->name('admin.laporanpenjualan');
    Route::get('/laporan-bulanan', [PesananController::class, 'laporanpenjualanBulanan'])->name('admin.laporanpenjualanBulanan');
    Route::get('/laporan-tahunan', [PesananController::class, 'laporanpenjualanTahunan'])->name('admin.laporanpenjualanTahunan');
    Route::get('/get-penjualan', [PesananController::class, 'lPenjualan'])->name('getPenjualan');

    Route::get('/produks', [ProdukController::class, 'produk'])->name('admin.kelolaproduk');
    Route::get('/tambahproduk', [ProdukController::class, 'viewtambahproduk'])->name('admin.tambahproduk');
    Route::post('/prosestambahproduk', [ProdukController::class, 'tambahproduk'])->name('admin.storeproduk');
    Route::get('/ubahproduk/{id}', [ProdukController::class, 'viewubahproduk'])->name('admin.ubahproduk');
    Route::post('/prosesubahproduk/{id}', [ProdukController::class, 'ubahproduk'])->name('admin.updateproduk');
    Route::get('/prosesubahstatusproduk/nonaktif/{id}', [ProdukController::class, 'ubahstatusproduknon'])->name('admin.updatestatusproduknon');
    Route::get('/produks/non-aktif', [ProdukController::class, 'produknonaktif'])->name('admin.kelolaproduknonaktif');
    Route::get('/prosesubahstatusproduk/aktif/{id}', [ProdukController::class, 'ubahstatusprodukaktf'])->name('admin.updatestatusprodukak');
    Route::get('/kategoriproduk', [KategoriController::class, 'kategoriproduk'])->name('admin.kelolakategoriproduk');
    Route::post('/prosestambahkategori', [KategoriController::class, 'tambahkategori'])->name('admin.storekategori');
    Route::get('/ubahkategoriproduk/{id}', [KategoriController::class, 'ubahkategori'])->name('admin.ubahkategoriproduk');
    Route::post('/prosesubahkategori/{id}', [KategoriController::class, 'prosesubahkategori'])->name('admin.ubahkategoripdk');
    Route::get('/hapuskategoriproduk/{id}', [KategoriController::class, 'hapuskategori'])->name('admin.hapuskategoriproduk');
    Route::get('/kelolapengguna', [UserController::class, 'user'])->name('admin.kelolapengguna');
    Route::get('/tambahpengguna', [UserController::class, 'viewtambahuser'])->name('admin.tambahpengguna');
    Route::post('/prosestambahuser', [UserController::class, 'tambahuser'])->name('admin.storepengguna');
    Route::get('/hapus/pengguna/{id}', [UserController::class, 'hapuspengguna'])->name('admin.hapuspengguna');
    Route::get('/ubahpengguna/{id}', [UserController::class, 'viewubahuser'])->name('admin.ubahpengguna');
    Route::post('/updatepengguna/{id}', [UserController::class, 'ubahpengguna'])->name('admin.updatepengguna');
    // add import file
    Route::get('/tambahpengguna/import', [UserController::class, 'viewimport']);
    Route::post('/prosestambahpengguna/import', [UserController::class, 'import'])->name('tambahpengguna.import');
    Route::get('/tambahproduk/import', [ProdukController::class, 'viewImportProduct']);
    Route::post('/prosestambahproduk/import', [ProdukController::class, 'importProduk'])->name('tambahproduk.import');

    // end import file
    Route::get('/kelola-metode-pembayaran', [MetodePembayaranController::class, 'kemetpem'])->name('admin.kelolametodepembayaran');
    Route::get('/tambah-metode-pembayaran', [MetodePembayaranController::class, 'tametpem'])->name('admin.tambahmetodepembayaran');
    Route::post('/prosestambahmetodepembayaran', [MetodePembayaranController::class, 'tambahmetpem'])->name('admin.storemetodepembayaran');
    Route::get('/ubah-metode-pembayaran/{id}', [MetodePembayaranController::class, 'ubmetpem'])->name('admin.ubahmetodepembayaran');
    Route::post('/prosesubahmetodepembayaran/{id}', [MetodePembayaranController::class, 'ubahmetpem'])->name('admin.updatemetodepembayaran');
    Route::post('/prosestambahkategoripembayaran', [MetodePembayaranController::class, 'tambahkapem'])->name('admin.storekategoripembayaran');
    Route::get('/hapus/kategoripembayaran/{id}', [MetodePembayaranController::class, 'hapuskapem'])->name('admin.hapuskategoripengguna');
    Route::get('/ubah-kategori-pembayaran/{id}', [MetodePembayaranController::class, 'ubkapem'])->name('admin.ubahkategoripembayaran');
    Route::post('/proses-ubah-kategori-pembayaran/{id}', [MetodePembayaranController::class, 'ubahkapem'])->name('admin.prosesubahkategoripembayaran');

    Route::get('/kelola-pesanan', [PesananController::class, 'kelolapesanan'])->name('admin.kelolapesanan');
    Route::get('/detail/pesanan/{id}', [PesananController::class, 'detailpesanan'])->name('admin.detailpesanan');
    Route::get('/ubah/status/{id}', [PesananController::class, 'ubahstatus'])->name('admin.ubahstatus');
    Route::post('/proses/ubah/status/{id}', [PesananController::class, 'updatestatus'])->name('admin.updatestatus');
    Route::get('/proses/ubah/status/batalkan/{id}', [PesananController::class, 'updatebatalkan'])->name('admin.updatebatalkan');
    Route::resource('beritas', BeritaController::class);
    Route::get('/kelola-berita', [BeritaController::class, 'berita'])->name('admin.kelolaberita');
    Route::get('/tambah-berita', [BeritaController::class, 'create'])->name('admin.tambahberita');
    Route::post('/prosestambahberita', [BeritaController::class, 'store'])->name('admin.storeberita');
    Route::get('/ubahberita/{id}', [BeritaController::class, 'edit'])->name('admin.ubahberita');
    Route::post('/prosesubahberita/{id}', [BeritaController::class, 'update'])->name('admin.updateberita');
    Route::get('/nonaktifkan-berita/{id}', [BeritaController::class, 'destroy'])->name('admin.nonaktifberita');
    Route::get('/aktifkan-berita/{id}', [BeritaController::class, 'aktifkan'])->name('admin.aktifberita');
});

Route::middleware(['auth', 'isPegawai'])->group(function () {
    Route::get('/dashboard-pegawai', function () {
        return view('frontend.dashboard-pegawai');
    });
});
