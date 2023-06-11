<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProdukModel;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\UkuranModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Mockery\Matcher\Not;
use App\Models\Corousel;
use App\Models\GantiRoles;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }

        $produk = Produk::all()->where('status_produk', 'Aktif');
        $unggulan = Produk::all()->where('produk_unggulan', 'Unggulan')->where('status_produk', "Aktif");
        $total_ung = Produk::select(DB::raw('count(id_produk) as total'))->groupBy("produk_unggulan")->where('produk_unggulan', 'Unggulan')->get();
        $kategori = KategoriProdukModel::all();
        $berita = Berita::where('status', 'Aktif')->orderBy('created_at', 'ASC')->first();
        $berita_2 = Berita::where('status', 'Aktif')->orderBy('created_at', 'ASC')->where('id','!=',$berita->id)->get();
        $corousel_f = Corousel::where('status', 1)->first();
        $corousel = Corousel::where('id','!=', $corousel_f->id)->where('status', 1)->get();

        $header = User::where('role_pengguna', "Admin")->first();

        return view('frontend.dashboard-pembeli', [
            'kategori' => $kategori,
            'produk' => $produk,
            'unggulan' => $unggulan,
            'pesanan' => $pesanan,
            'pesanan_baru' => $pesanan_baru,
            'pengguna_prof' => $pengguna_prof,
            'total_ung' => $total_ung,
            'berita' => $berita,
            'berita_2' => $berita_2,
            'corousel_f'=>$corousel_f,
            'corousel'=>$corousel,
            'header'=>$header
        ]);
    }

    public function cariProduk(Request $request)
    {
        $cari = $request->cari;
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }

        $produk = Produk::where('nama_produk', 'like', '%' . $cari . '%')->where('status_produk', 'Aktif')->get();
        // dd($produk);

        $unggulan = Produk::where('nama_produk', 'like', '%' . $cari . '%')->where('produk_unggulan', 'Unggulan')->get();

        $total_ung = Produk::select(DB::raw('count(id_produk) as total'))->groupBy("produk_unggulan")->where('produk_unggulan', 'Unggulan')->where('nama_produk', 'like', '%' . $cari . '%')->get();

        foreach ($produk as $p) {
            $kategori = KategoriProdukModel::where('kategori', $p->kategori_produk)->get();
            // dd($kategori);
        }

        $ukuran = UkuranModel::all();

        // $kategori = KategoriProdukModel::where('kategori', $produk->kategori_produk)->get();
        // dd($kategori);
        return view('pembeli.viewproduk', [
            'kategori' => $kategori,
            'ukuran' => $ukuran,
            'produk' => $produk,
            'unggulan' => $unggulan,
            'pesanan' => $pesanan,
            'pesanan_baru' => $pesanan_baru,
            'pengguna_prof' => $pengguna_prof,
            'total_ung' => $total_ung
        ]);
    }

    public function produk()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $produk = Produk::where('status_produk', 'Aktif')->get();
        $kategori = KategoriProdukModel::all();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $ukuran = UkuranModel::all();
        return view('pembeli.viewproduk', [
            'produk' => $produk,
            'ukuran' => $ukuran,
            'kategori' => $kategori,
            'pesanan' => $pesanan,
            'pesanan_baru' => $pesanan_baru,
            'pengguna_prof' => $pengguna_prof
        ]);
    }

    public function produkFilterUkuran(Request $request) {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }

        $kategori = KategoriProdukModel::all();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $ukuran = UkuranModel::all();


        if($request->input('ukuran') != null){
            $selectedUkuran = implode(',', $request->input('ukuran'));
            $arr = explode(',', $selectedUkuran);
            // dd(count($arr));
            for($i = 0; $i < count($arr); $i++) {
                $produk = Produk::where('ukuran_produk', 'like', '%' . $arr[$i] . '%')->where('status_produk', 'Aktif')->get();
                // $produk = Produk::where('ukuran_produk', $arr[$i])->where('status_produk', 'Aktif')
                // ->get();
            }
            // dd($produk);

            // dd($arr[1]);
            // dd($arr);


            return view('pembeli.viewproduk', [
                'produk' => $produk,
                'ukuran' => $ukuran,
                'kategori' => $kategori,
                'pesanan' => $pesanan,
                'pesanan_baru' => $pesanan_baru,
                'pengguna_prof' => $pengguna_prof
            ]);
        } else {
            $produk = Produk::where('status_produk', 'Aktif')->get();
            return view('pembeli.viewproduk', [
                'produk' => $produk,
                'ukuran' => $ukuran,
                'kategori' => $kategori,
                'pesanan' => $pesanan,
                'pesanan_baru' => $pesanan_baru,
                'pengguna_prof' => $pengguna_prof
            ]);
        }

    }

    public function cariProduk2(Request $request)
    {
        $cari = $request->cari;

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {

            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }

        $produk = Produk::where('nama_produk', 'like', '%' . $cari . '%')->where('status_produk', 'Aktif')->get();

        $kategori = KategoriProdukModel::all();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $ukuran = UkuranModel::all();
        return view('pembeli.viewproduk', [
            'produk' => $produk,
            'ukuran' => $ukuran,
            'kategori' => $kategori,
            'pesanan' => $pesanan,
            'pesanan_baru' => $pesanan_baru,
            'pengguna_prof' => $pengguna_prof
        ]);
    }

    public function detail_produk($id)
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $produk = Produk::all()->where('id_produk', $id)->where('status_produk', 'Aktif');

        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $ukuran = UkuranModel::all();
        return view('pembeli.detailproduk', [
            'produk' => $produk,
            'ukuran' => $ukuran,
            'pesanan' => $pesanan,
            'pengguna_prof' => $pengguna_prof,
            'pesanan_baru' => $pesanan_baru,
        ]);
    }

    public function produk_kategori($id)
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $kategori = KategoriProdukModel::all();
        $produk = DB::table('produk')
            ->join('kategoriproduk', 'kategoriproduk.kategori', '=', 'produk.kategori_produk')
            ->where('kategoriproduk.kategori', $id)
            ->where('produk.status_produk', 'Aktif')
            ->get();
        return view('pembeli.viewproduk', [
            'pesanan' => $pesanan,
            'produk' => $produk,
            'kategori' => $kategori,
            'pesanan_baru' => $pesanan_baru,
            'pengguna_prof' => $pengguna_prof
        ]);
    }

    public function dashboard()
    {
        //Data statistik
        DB::statement("SET SQL_MODE=''");
        $now = Carbon::now();
        // dd($now);
        $bulan = Pesanan::select(DB::raw('MonthName(tanggal) as bulanp'))
            ->GroupBy(DB::raw('MonthName(tanggal)'))->OrderBy('tanggal', 'ASC')->whereYear('tanggal', $now)->pluck('bulanp');

        $totalpemasukan = Pesanan::select("total_harga", DB::raw('CAST(SUM(total_harga) as UNSIGNED INTEGER ) as totalp'))
            ->groupBy(DB::raw('MonthName(tanggal)'))->OrderBy('tanggal', 'ASC')
            ->whereYear('tanggal', $now)->where('pesanans.status','Selesai')->pluck('totalp');

        $totalproduk = DB::table('pesanans')->select(DB::raw('CAST(count(id) as UNSIGNED INTEGER ) as totalpr'))->groupBy(DB::raw('MonthName(tanggal)'))->OrderBy('tanggal', 'ASC')->whereYear('tanggal', $now)->where('pesanans.status','Selesai')->pluck('totalpr');

        $tahun = $now->format('Y');
        $date = $now->format('l, d F Y');

        //total

        $jumlahproduk = DB::table('pesanans')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->select(DB::raw('SUM(pesanandetails.jumlah) as totalproduk'))->where('pesanans.status','!=','keranjang')->whereYear('tanggal', $now)->get();

        $jumlahpendapatan = Pesanan::select("total_harga", DB::raw('SUM(total_harga) as totalpes'))->where('pesanans.status','Selesai')->whereYear('tanggal', $now)->get();

        $jumlahpengguna = User::select("id",DB::raw('count(id) as totalpeng'))->whereYear('created_at', $now)->get();

        //pesanan
        $jumlahSelesai = Pesanan::select("id",DB::raw('count(id) as total'))->where('status', 'Selesai')->get();
        $jumlahDiambil = Pesanan::select("id",DB::raw('count(id) as total'))->where('status', 'Siap Diambil')->get();
        $jumlahProses = Pesanan::select("id",DB::raw('count(id) as total'))->where('status', 'Sedang Diproses')->get();
        $jumlahTangguh = Pesanan::select("id",DB::raw('count(id) as total'))->where('status', 'Ditangguhkan')->get();
        $jumlahBatal = Pesanan::select("id",DB::raw('count(id) as total'))->where('status', 'Batalkan')->get();

        //Pesanan Harian
        $pesanan_harian = DB::table('pesanans')->join('users','users.id','=','pesanans.user_id')->whereDate('pesanans.tanggal', $now)->where('pesanans.status','!=','keranjang')->where('pesanans.status', '!=', 'checkout')->paginate(10);

        $konfirmasi_pengguna = GantiRoles::where('status', 'Menunggu')->count();

        $barang_habis = Produk::where('jumlah_produk', "<=", 5)->where('status_produk', 'Aktif')->count();

        $pesanan_datang = Pesanan::where('status', 'Sedang Diproses')->orWhere('status', 'Ditangguhkan')->count();

        return view('frontend.dashboard-admin', [
            'bulan' => $bulan,
            'totalpemasukan' => $totalpemasukan,
            'totalproduk' => $totalproduk,
            'tahun' => $tahun,
            'jumlahproduk' => $jumlahproduk,
            'jumlahpendapatan'=>$jumlahpendapatan,
            'jumlahpengguna'=>$jumlahpengguna,
            'jumlahSelesai'=>$jumlahSelesai,
            'jumlahDiambil'=>$jumlahDiambil,
            'jumlahProses'=>$jumlahProses,
            'jumlahTangguh'=>$jumlahTangguh,
            'jumlahBatal'=>$jumlahBatal,
            'date'=>$date,
            'pesanan_harian'=>$pesanan_harian,
            'konfirmasi_pengguna'=>$konfirmasi_pengguna,
            'barang_habis'=>$barang_habis,
            'pesanan_datang'=>$pesanan_datang
        ]);
    }
}
