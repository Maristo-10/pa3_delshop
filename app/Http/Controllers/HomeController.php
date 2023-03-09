<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProdukModel;
use Illuminate\Support\Facades\DB;

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
        $produk = Produk::all()->where('status_produk','Aktif');
        $unggulan=Produk::all()->where('produk_unggulan','Unggulan');
        $kategori = KategoriProdukModel::all();
        return view('frontend.dashboard-pembeli',[
            'kategori'=>$kategori,
            'produk'=>$produk,
            'unggulan'=>$unggulan
        ]);
    }

    public function produk()
    {
        $produk = Produk::all()->where('status_produk','Aktif');
        $kategori = KategoriProdukModel::all();
        return view('pembeli.viewproduk',[
            'produk'=>$produk,
            'kategori'=>$kategori
        ]);
    }

    public function detail_produk($id)
    {
        $produk = Produk::all()->where('id_produk',$id)->where('status_produk','Aktif');
        return view('pembeli.detailproduk',compact('produk'));
    }

    public function produk_kategori($id)
    {
        $kategori = KategoriProdukModel::all();
        $produk = DB::table('produk')
        ->join('kategoriproduk', 'kategoriproduk.kategori', '=', 'produk.kategori_produk')
        ->where('kategoriproduk.kategori',$id)
        ->where('produk.status_produk','Aktif')
        ->get();
        return view('pembeli.viewproduk',[
            'produk'=>$produk,
            'kategori'=>$kategori
        ]);



    }
}

?>
