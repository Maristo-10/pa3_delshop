<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriProdukModel;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kategoriproduk(){
        $kategoriproduk = KategoriProdukModel::paginate(1);
        return view('admin.kelolakategoriproduk',compact('kategoriproduk'));
    }

    public function tambahkategori( Request $request){
        $arrName = [];

        $tambahkategori = new KategoriProdukModel();
        $tambahkategori->kategori = $request->kategori;
        if($request->file('gambar_kategori')){

            if ($request->hasfile('gambar_kategori')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('gambar_kategori')->getClientOriginalName());
                $request->file('gambar_kategori')->move(public_path('category-images'), $filename);
                $tambahkategori->gambar_kategori = $filename;
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        if (!$tambahkategori->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }

        return redirect()->route("admin.kelolakategoriproduk");
    }

    public function ubahkategori($id){
        $kategoriproduk = KategoriProdukModel::all()->where('kategori', $id);
        $datakategori = KategoriProdukModel::all();
        return view('admin.ubahkategoriproduk',[
            'kategoriproduk'=>$kategoriproduk,
            'datakategori'=>$datakategori
        ]);
    }

    public function prosesubahkategori(Request $request, $id){
        $kategoriproduk= KategoriProdukModel::where('kategori', $id);
        $kategori = $request->kategori;
        if($request->file('gambar_kategori')){
            if ($request->hasfile('gambar_kategori')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('gambar_kategori')->getClientOriginalName());
                $request->file('gambar_kategori')->move(public_path('category-images'), $filename);
                $kategoriproduk->update(['gambar_kategori'=>$filename]);
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }

        $kategoriproduk->update(['kategori'=>$kategori]);
        return redirect()->route('admin.kelolakategoriproduk');
    }

    public function hapuskategori($id){
        KategoriProdukModel::where('kategori', $id)->delete();

        return redirect()->route('admin.kelolakategoriproduk');
    }

}
