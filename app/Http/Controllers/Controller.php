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

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index2()
    {
        if(route('login') && route('register')){
            $pesanan= 0;
            $pengguna_prof =0;
        }else{
            $pengguna_prof = User::where('id', Auth::user()->id)->get();
            $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        // $pesanan = DetailPesanan::select("*", DB::raw('count("id") as total'))->groupBy("id")->where('pesanan_id',$pesanan_baru->id)->get();
            $pesanan =DetailPesanan::all()->where('pesanan_id',$pesanan_baru->id)->count();
        }

        $unggulan=Produk::all()->where('produk_unggulan','Unggulan');
        $kategori = KategoriProdukModel::all();
        return view('frontend.dashboard-pembeli',[
            'kategori'=>$kategori,
            'unggulan'=>$unggulan,
            'pesanan'=>$pesanan,
            'pengguna_prof'=>$pengguna_prof
        ]);
    }
}
