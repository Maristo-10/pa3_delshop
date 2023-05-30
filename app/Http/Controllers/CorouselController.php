<?php

namespace App\Http\Controllers;

use App\Models\Corousel;
use Illuminate\Http\Request;

class CorouselController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kelolaCorousel()
    {
        $corousel = Corousel::all();
        return view('admin.corousel',[
            'corousel' => $corousel
        ]);
    }

    public function tambahCorousel(Request $request)
    {
        $corousel = new Corousel;
        $arrName = [];
        if($request->file('gambar_corousel')){
            if ($request->hasfile('gambar_corousel')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('gambar_corousel')->getClientOriginalName());
                $request->file('gambar_corousel')->move(public_path('corousel-images'), $filename);
                $corousel->gambar_corousel = $filename;
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $$corousel->gambar_produk = $request->gambar_produk;
        }
        if (!$corousel->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }

        return redirect()->route("admin.corousel")->with('success','Data Corousel Berhasil Di Tambahkan');
    }

    public function ubahCorousel(Request $request, $id)
    {
        $corousel = Corousel::find($id);
        if($request->file('gambar_corousel')){
            if ($request->hasfile('gambar_corousel')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('gambar_corousel')->getClientOriginalName());
                $request->file('gambar_corousel')->move(public_path('corousel-images'), $filename);
                $corousel->update(['gambar_corousel'=>$filename]);
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        return redirect()->route('admin.corousel')->with('success','Data Corousel Berhasil di Ubah');
    }

    public function aktifkan($id){
        $corousel = Corousel::find($id);
        $corousel->update([
            'status'=> 1
        ]);

        return redirect()->route('admin.corousel')->with('success','Data Corousel Berhasil di Aktifkan');
    }

    public function non_aktifkan($id){
        $corousel = Corousel::find($id);
        $corousel->update([
            'status'=> 0
        ]);

        return redirect()->route('admin.corousel')->with('success','Data Corousel Berhasil di Non-Aktifkan');
    }
}
