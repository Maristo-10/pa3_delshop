<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProdukModel;
use App\Models\Role;

class ProdukController extends Controller
{
    public function produk(){
        $produk = Produk::all()->where('status_produk','Aktif');
        return view('admin.kelolaproduk',compact('produk'));
    }

    public function viewtambahproduk(){
        $kategori_produk = KategoriProdukModel::all();
        $role = Role::all()->where('kategori_role','Pembeli');
        return view('admin.tambahproduk',[
            'kategori_produk'=>$kategori_produk,
            'role'=>$role
        ]);
    }

    public function tambahproduk(Request $request){
        $arrName = [];
        $id = $request->id;


        $validatedData = $request->validate([
            'gambar_produk'=>'image|file|max:10000'
        ]);

        $tambahproduk = new Produk();
        $tambahproduk->nama_produk = $request->nama_produk;
        $tambahproduk->harga = $request->harga;
        $tambahproduk->jumlah_produk = $request->jumlah_produk;
        $tambahproduk->role_pembeli = $request->role_pembeli;
        $tambahproduk->kategori_produk = $request->kategori_produk;
        $tambahproduk->produk_unggulan = $request->produk_unggulan;
        $tambahproduk->deskripsi = $request->deskripsi;
        if($request->file('gambar_produk')){

            if ($request->hasfile('gambar_produk')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('gambar_produk')->getClientOriginalName());
                $request->file('gambar_produk')->move(public_path('product-images'), $filename);
                $tambahproduk->gambar_produk = $filename;
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        if (!$tambahproduk->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }

        return redirect()->route("admin.kelolaproduk");
    }

    public function viewubahproduk($id){
        $produk = Produk::find($id);
        $kategori_produk = KategoriProdukModel::all();
        $role = Role::all()->where('kategori_role','Pembeli');

        return view('admin.ubahproduk', [
            'produk'=>$produk,
            'kategori_produk'=>$kategori_produk,
            'role'=>$role
        ]);
    }

    public function ubahproduk(Request $request, $id){
        $produk = Produk::find($id);
        $produk->update($request->all());

        return redirect()->route('admin.kelolaproduk');
    }

    public function ubahstatusproduknon($id){
        $produk = Produk::find($id);
        $produk->update(['status_produk'=>'Non-Aktif']);

        return redirect()->route('admin.kelolaproduk');
    }

    public function produknonaktif(){
        $produk = Produk::all()->where('status_produk','Non-Aktif');
        return view('admin.kelolaproduknonaktif',compact('produk'));
    }

    public function ubahstatusprodukaktf($id){
        $produk = Produk::find($id);
        $produk->update(['status_produk'=>'Aktif']);

        return redirect()->route('admin.kelolaproduknonaktif');
    }


}

?>
