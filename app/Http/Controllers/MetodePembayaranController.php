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
        
    // fungsi untuk menon-aktifkan metode pembayaran
    public function ubahStatusMetpenNon($id) {

        // dd($id);
        $metpem = MetodePembayaran::find($id);
        $metpem->update(['status_metpem'=>'Non-Aktif']);

        return redirect()->route('admin.kelolametodepembayaran')->with('success','Data Metode Pembayaran Berhasil Di Non aktifkan');;
    }

    // fungsi untuk melihat metode pembayaran yang tidak aktif
    public function metpemnonaktif(){
        $metpemNonAktif = MetodePembayaran::where('status_metpem','Non-Aktif')->paginate(5);
        return view('admin.kelolametpemnonaktif',['metpemNonAktif'=>$metpemNonAktif]);
    }

    // fungsi untuk mengaktifkan metode pembayaran
    public function metpemAktif($id) {
        $metpem = MetodePembayaran::find($id);
        $metpem->update(['status_metpem'=>'Aktif']);

        return redirect()->route('admin.kelolametodepembayaran')->with('success','Data Metode Pembayaran Berhasil Di Aktifkan');

    }

    public function kemetpem(){
        $metpem = MetodePembayaran::paginate(5);
        $kapem = KategoriPembayaran::paginate(5);

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
        $tambahmetpem->layanan = $request->nama_layanan;
        $tambahmetpem->no_layanan = $request->no_layanan;
        $tambahmetpem->nama_pemilik = $request->nama_pemilik;
        $id_kapem = $request->kategori_layanan;
        $tambahmetpem->kategori_layanan = $id_kapem;
        $kapem = KategoriPembayaran::where('id_kapem',$id_kapem)->get('kategori_pembayaran')->implode('kategori_pembayaran'," ");
        $tambahmetpem->kapem = $kapem;

        if (!$tambahmetpem->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }

        return redirect()->route("admin.kelolametodepembayaran")->with('success','Proses Berhasil di lakukan');
    }

    public function ubmetpem($id){
        $metpem=MetodePembayaran::where('id_metpem', $id)->first();
        $kapem = KategoriPembayaran::all();

        return view('admin.ubahmetodepembayaran',[
            'kapem'=>$kapem,
            'metpem'=>$metpem
        ]);
    }

    public function ubahmetpem(Request $request, $id){
        $metpem=MetodePembayaran::where('id_metpem',$id);;

        $metpem->update($request->all());

        return redirect()->route('admin.kelolametodepembayaran')->with('success','Proses Berhasil di lakukan');
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

        return redirect()->route("admin.kelolametodepembayaran")->with('success','Proses Berhasil di lakukan');
    }

    public function hapuskapem($id){
        $kapem = KategoriPembayaran::where('kategori_pembayaran',$id);
        $kapem->delete();

        return redirect()->route('admin.kelolametodepembayaran')->with('success','Data Berhasil di hapus');
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

        return redirect()->route('admin.kelolametodepembayaran')->with('success','Proses Berhasil di lakukan');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * return metode_pembayaran list.
     *
     * @return json
     */
    // public function metpem($id){

    //     $metpem = MetodePembayaran::where('kategori_layanan',$id)->get();

    //     return response()->json($metpem);
    // }

    public function metpem(Request $request){
        $metpem = MetodePembayaran::where('kategori_layanan', $request->kapem_id)->get();
        return response()->json($metpem);
    }

    public function layanan(Request $request){
        $metpem = MetodePembayaran::where('id_metpem', $request->metpem_id)->get();
        return response()->json($metpem);
    }
}
