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
use App\Models\Corousel;
use App\Models\UkuranModel;
use Illuminate\Http\Request;

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
        $pengguna_prof = [0];

        $unggulan = Produk::where('produk_unggulan', 'Unggulan')->take(7)->get();
        $kategori = KategoriProdukModel::all();
        $total_ung = Produk::select(DB::raw('count(id_produk) as total'))->groupBy("produk_unggulan")->where('produk_unggulan','Unggulan')->get();
        // $total_ung = Produk::select(DB::raw('count(id_produk) as total'))
        //     ->from(DB::raw('(SELECT id_produk FROM produk WHERE produk_unggulan = "Unggulan" LIMIT 5) as subquery'))
        //     ->whereIn('id_produk', function ($query) {
        //         $query->select('id_produk')
        //             ->from('produk')
        //             ->where('produk_unggulan', 'Unggulan')
        //             ->where('status_produk', 'Aktif');
        //     })
        //     ->groupBy(DB::raw('(SELECT "Unggulan")'))
        //     ->get();

        // dd($total_ung);

        $berita = Berita::where('status', 'Aktif')->orderBy('created_at', 'ASC')->first();
        $berita_2 = Berita::where('status', 'Aktif')->orderBy('created_at', 'ASC')->where('id', '!=', $berita->id)->get();

        $corousel_f = Corousel::where('status', 1)->first();
        $corousel = Corousel::where('id', '!=', $corousel_f->id)->where('status', 1)->get();
        $header = User::where('role_pengguna', "Admin")->first();
        return view('frontend.dashboard-pembeli', [
            'kategori' => $kategori,
            'unggulan' => $unggulan,
            'pesanan' => $pesanan,
            'pengguna_prof' => $pengguna_prof,
            'total_ung' => $total_ung,
            'berita' => $berita,
            'berita_2' => $berita_2,
            'corousel_f' => $corousel_f,
            'corousel' => $corousel,
            'header' => $header
        ]);
    }

    public function produk()
    {
        $pesanan = [0];
        $pengguna_prof = [0];

        $produk = Produk::where('status_produk', 'Aktif')->get();
        $kategori = KategoriProdukModel::all();
        $ukuran = UkuranModel::all();
        $header = User::where('role_pengguna', "Admin")->first();
        return view('pembeli.viewproduk', [
            'produk' => $produk,
            'ukuran' => $ukuran,
            'kategori' => $kategori,
            'pesanan' => $pesanan,
            'pengguna_prof' => $pengguna_prof,
            'header' => $header
        ]);
    }

    public function cariProduk(Request $request)
    {
        $cari = $request->cari;
        $pesanan = [0];
        $pengguna_prof = [0];

        $produk = Produk::where('nama_produk', 'like', '%' . $cari . '%')->where('status_produk', 'Aktif')->get();
        // dd($produk);

        $unggulan = Produk::where('nama_produk', 'like', '%' . $cari . '%')->where('produk_unggulan', 'Unggulan')->get();

        $total_ung = Produk::select(DB::raw('count(id_produk) as total'))->groupBy("produk_unggulan")->where('produk_unggulan', 'Unggulan')->where('nama_produk', 'like', '%' . $cari . '%')->get();

        foreach ($produk as $p) {
            $kategori = KategoriProdukModel::where('kategori', $p->kategori_produk)->get();
            // dd($kategori);
        }

        $ukuran = UkuranModel::all();
        $header = User::where('role_pengguna', "Admin")->first();

        // $kategori = KategoriProdukModel::where('kategori', $produk->kategori_produk)->get();
        // dd($kategori);
        return view('pembeli.viewproduk', [
            'kategori' => $kategori,
            'ukuran' => $ukuran,
            'produk' => $produk,
            'unggulan' => $unggulan,
            'pesanan' => $pesanan,
            'pengguna_prof' => $pengguna_prof,
            'total_ung' => $total_ung,
            'header' => $header
        ]);
    }

    public function filterByCategory($category)
    {
        $products = Produk::where('kategori_produk', $category)->get();

        $pesanan = [0];
        $pengguna_prof = [0];
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $kategori = KategoriProdukModel::all();
        $ukuran = UkuranModel::all();
        $header = User::where('role_pengguna', "Admin")->first();
        return view('pembeli.viewproduk', [
            'produk' => $products,
            'ukuran' => $ukuran,
            'kategori' => $kategori,
            'pesanan' => $pesanan,
            'pengguna_prof' => $pengguna_prof,
            'header' => $header
        ]);
    }

    public function cariProduk2(Request $request)
    {
        $cari = $request->cari;

        $pesanan = [0];
        $pengguna_prof = [0];

        $produk = Produk::where('nama_produk', 'like', '%' . $cari . '%')->where('status_produk', 'Aktif')->get();

        $kategori = KategoriProdukModel::all();
        $ukuran = UkuranModel::all();
        $header = User::where('role_pengguna', "Admin")->first();
        return view('pembeli.viewproduk', [
            'produk' => $produk,
            'ukuran' => $ukuran,
            'kategori' => $kategori,
            'pesanan' => $pesanan,
            'pengguna_prof' => $pengguna_prof,
            'header' => $header
        ]);
    }

    public function sorting(Request $request)
    {
        $sort = $request->input('sort');

        $items = Produk::query();
        if ($sort) {
            if ($sort == 'latest') {
                $items->orderBy('created_at', 'desc');
            } elseif ($sort == 'termahal') {
                $items->orderBy('harga', 'desc');
            } elseif ($sort == 'termurah') {
                $items->orderBy('harga', 'asc');
            } elseif ($sort == 'all') {
                $items = $items;
            }
        }
        $pesanan = [0];
        $pengguna_prof = [0];
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $kategori = KategoriProdukModel::all();
        $produk = $items->get();
        $ukuran = UkuranModel::all();
        $header = User::where('role_pengguna', "Admin")->first();
        return view('pembeli.viewproduk', [
            'produk' => $produk,
            'ukuran' => $ukuran,
            'kategori' => $kategori,
            'pesanan' => $pesanan,
            'pengguna_prof' => $pengguna_prof,
            'header' => $header
        ]);
    }
}
