<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProdukModel;
use App\Models\Pesanan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UkuranModel;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // function to import produk data excel
    public function importProduk(Request $request) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move('ProductsData', $fileName);
        Excel::import(new ProductsImport, \public_path('/ProductsData/'.$fileName));

        return redirect()->route('admin.kelolaproduk');
    }

    public function viewImportProduct() {
        return view('admin.tambahprodukimport');
    }

    public function produk(){
        $produk = Produk::paginate(5)->where('status_produk','Aktif');
        return view('admin.kelolaproduk',compact('produk'));
    }

    // sorting produk
    public function sorting(Request $request) {
        $sort = $request->input('sort');

        $items = Produk::query();
        if ($sort) {
            if ($sort == 'latest') {
                $items->orderBy('created_at', 'desc');
            } elseif ($sort == 'termahal') {
                $items->orderBy('harga', 'desc');
            } elseif ($sort == 'termurah') {
                $items->orderBy('harga', 'asc');
            }
        }
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }
        $kategori = KategoriProdukModel::all();
        $produk = $items->get();
        $ukuran = UkuranModel::all();
        return view('pembeli.viewproduk',[
            'produk'=>$produk,
            'ukuran'=>$ukuran,
            'kategori'=>$kategori,
            'pesanan'=>$pesanan,
            'pesanan_baru'=>$pesanan_baru,
            'pengguna_prof'=>$pengguna_prof
        ]);
    }

    public function viewtambahproduk(){
        $kategori_produk = KategoriProdukModel::all();
        $role = Role::all()->where('kategori_role','Pembeli');
        $ukuran = UkuranModel::all();
        return view('admin.tambahproduk',[
            'kategori_produk'=>$kategori_produk,
            'role'=>$role,
            'ukuran'=>$ukuran
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

        $nama_produk = $request->nama_produk;
        $harga = $request->harga;
        $jumlah_produk = $request->jumlah_produk;
        $role_pembeli = $request->role_pembeli;
        $kategori_produk = $request->kategori_produk;
        $produk_unggulan = $request->produk_unggulan;
        $deskripsi = $request->deskripsi;
        if($request->file('gambar_produk')){
            if ($request->hasfile('gambar_produk')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('gambar_produk')->getClientOriginalName());
                $request->file('gambar_produk')->move(public_path('product-images'), $filename);
                $produk->update(['gambar_produk'=>$filename]);
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        $produk->update([
            'nama_produk'=>$nama_produk,
            'harga'=>$harga,
            'jumlah_produk'=>$jumlah_produk,
            'role_pembeli'=>$role_pembeli,
            'kategori_produk'=>$kategori_produk,
            'produk_unggulan'=>$produk_unggulan,
            'deskripsi'=>$deskripsi
        ]);

        return redirect()->route('admin.kelolaproduk');
    }

    public function ubahstatusproduknon($id, Request $request){
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
