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
        $kapem = KategoriPembayaran::all();

        return view('admin.kelolametodepembayaran',[
            'metpem'=>$metpem,
            'kapem'=>$kapem
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

    public function ubmetpem($id){
        $metpem=MetodePembayaran::find($id);
        $kapem = KategoriPembayaran::all();

        return view('admin.ubahmetodepembayaran',[
            'kapem'=>$kapem,
            'metpem'=>$metpem
        ]);
    }

    public function ubahmetpem(Request $request, $id){
        $metpem=MetodePembayaran::find($id);

        $metpem->update($request->all());

        return redirect()->route('admin.kelolametodepembayaran');
    }

    public function tambahkapem(Request $request){
        $arrName = [];

        $tambahkapem = new KategoriPembayaran();
        $tambahkapem->kategori_pembayaran = $request->kategori_pembayaran;

        if (!$tambahkapem->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }

        return redirect()->route("admin.kelolametodepembayaran");
    }

    public function hapuskapem($id){
        $kapem = KategoriPembayaran::where('kategori_pembayaran',$id);
        $kapem->delete();

        return redirect()->route('admin.kelolametodepembayaran');
    }

    public function ubkapem($id){
        $metpem=MetodePembayaran::all();
        $kapem = KategoriPembayaran::all();
        $kapemid = KategoriPembayaran::where('kategori_pembayaran',$id)->get();

        return view('admin.ubahkategoripembayaran',[
            'kapem'=>$kapem,
            'metpem'=>$metpem,
            'kapemid'=>$kapemid
        ]);
    }

    public function ubahkapem(Request $request, $id){
        $kapem=KategoriPembayaran::where('kategori_pembayaran',$id);

        $kapem->update($request->except(['_token']));

        return redirect()->route('admin.kelolametodepembayaran');
    }
}
