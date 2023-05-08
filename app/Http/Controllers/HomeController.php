<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProdukModel;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\UkuranModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }

        $produk = Produk::all()->where('status_produk','Aktif');
        $unggulan=Produk::all()->where('produk_unggulan','Unggulan');
        $total_ung = Produk::select(DB::raw('count(id_produk) as total'))->groupBy("produk_unggulan")->where('produk_unggulan','Unggulan')->get();
        $kategori = KategoriProdukModel::all();
        return view('frontend.dashboard-pembeli',[
            'kategori'=>$kategori,
            'produk'=>$produk,
            'unggulan'=>$unggulan,
            'pesanan'=>$pesanan,
            'pesanan_baru'=>$pesanan_baru,
            'pengguna_prof'=>$pengguna_prof,
            'total_ung'=>$total_ung
        ]);
    }

    public function cariProduk(Request $request) {
        $cari = $request->cari;
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }

        $produk = Produk::where('nama_produk', 'like', '%'.$cari.'%')->where('status_produk', 'Aktif')->get();
        // dd($produk);

        $unggulan = Produk::where('nama_produk', 'like', '%'.$cari.'%')->where('produk_unggulan', 'Unggulan')->get();

        $total_ung = Produk::select(DB::raw('count(id_produk) as total'))->groupBy("produk_unggulan")->where('produk_unggulan','Unggulan')->where('nama_produk', 'like', '%'.$cari.'%')->get();

        foreach ($produk as $p ) {
            $kategori = KategoriProdukModel::where('kategori', $p->kategori_produk)->get();
            // dd($kategori);
        }

        // $kategori = KategoriProdukModel::where('kategori', $produk->kategori_produk)->get();
        // dd($kategori);
        return view('frontend.dashboard-pembeli',[
            'kategori'=>$kategori,
            'produk'=>$produk,
            'unggulan'=>$unggulan,
            'pesanan'=>$pesanan,
            'pesanan_baru'=>$pesanan_baru,
            'pengguna_prof'=>$pengguna_prof,
            'total_ung'=>$total_ung
        ]);
    }

    public function produk()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }
        $produk = Produk::where('status_produk','Aktif')->get();
        $kategori = KategoriProdukModel::all();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $ukuran = UkuranModel::all();
        return view('pembeli.viewproduk',[
            'produk'=>$produk,
            'ukuran'=>$ukuran,
            'kategori'=>$kategori,
            'pesanan'=>$pesanan,
            'pesanan_baru'=>$pesanan_baru,
            'pengguna_prof'=>$pengguna_prof
        ]);
    }

    public function cariProduk2(Request $request) {
        $cari = $request->cari;

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }

        $produk = Produk::where('nama_produk', 'like', '%'.$cari.'%')->where('status_produk', 'Aktif')->get();

        $kategori = KategoriProdukModel::all();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        return view('pembeli.viewproduk',[
            'produk'=>$produk,
            'kategori'=>$kategori,
            'pesanan'=>$pesanan,
            'pesanan_baru'=>$pesanan_baru,
            'pengguna_prof'=>$pengguna_prof
        ]);
    }

    public function detail_produk($id)
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }
        $produk = Produk::all()->where('id_produk',$id)->where('status_produk','Aktif');

        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        return view('pembeli.detailproduk',[
            'produk'=>$produk,
            'pesanan'=>$pesanan,
            'pengguna_prof'=>$pengguna_prof,
            'pesanan_baru'=>$pesanan_baru,
        ]);
    }

    public function produk_kategori($id)
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }
        $kategori = KategoriProdukModel::all();
        $produk = DB::table('produk')
        ->join('kategoriproduk', 'kategoriproduk.kategori', '=', 'produk.kategori_produk')
        ->where('kategoriproduk.kategori',$id)
        ->where('produk.status_produk','Aktif')
        ->get();
        return view('pembeli.viewproduk',[
            'pesanan'=>$pesanan,
            'produk'=>$produk,
            'kategori'=>$kategori,
            'pesanan_baru'=>$pesanan_baru,
            'pengguna_prof'=>$pengguna_prof
        ]);
    }
}

?>
