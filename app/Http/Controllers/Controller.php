<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\KategoriProdukModel;
use App\Models\Produk;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Berita;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index2()
    {
            $pesanan = [0];
            $pengguna_prof =[0];

        $unggulan=Produk::all()->where('produk_unggulan','Unggulan');
        $kategori = KategoriProdukModel::all();
        $total_ung = Produk::select(DB::raw('count(id_produk) as total'))->groupBy("produk_unggulan")->where('produk_unggulan','Unggulan')->get();
        $berita = Berita::where('status', 'Aktif')->orderBy('created_at', 'ASC')->first();
        $berita_2 = Berita::where('status', 'Aktif')->orderBy('created_at', 'ASC')->where('id','!=',$berita->id)->get();
        return view('frontend.dashboard-pembeli',[
            'kategori'=>$kategori,
            'unggulan'=>$unggulan,
            'pesanan'=>$pesanan,
            'pengguna_prof'=>$pengguna_prof,
            'total_ung'=>$total_ung,
            'berita' => $berita,
            'berita_2' => $berita_2
        ]);
    }
}
