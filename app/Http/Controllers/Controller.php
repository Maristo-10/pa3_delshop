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
        return view('frontend.dashboard-pembeli',[
            'kategori'=>$kategori,
            'unggulan'=>$unggulan,
            'pesanan'=>$pesanan,
            'pengguna_prof'=>$pengguna_prof
        ]);
    }
}
