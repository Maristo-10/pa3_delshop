<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use App\Models\KategoriPembayaran;

class MetodePembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kemetpem(){
        $metpem = MetodePembayaran::all();

        return view('admin.kelolametodepembayaran',[
            'metpem'=>$metpem
        ]);
    }

    public function tametpem(){
        $kapem = KategoriPembayaran::all();

        return view('admin.tambahmetodepembayaran',[
            'kapem'=>$kapem
        ]);
    }

    public function tambahmetpem(Request $request){
        $arrName = [];

        $tambahmetpem = new MetodePembayaran();
        $tambahmetpem->nama_layanan = $request->nama_layanan;
        $tambahmetpem->no_layanan = $request->no_layanan;
        $tambahmetpem->nama_pemilik = $request->nama_pemilik;
        $tambahmetpem->kategori_layanan = $request->kategori_layanan;
        if (!$tambahmetpem->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }

        return redirect()->route("admin.kelolametodepembayaran");
    }
}
