<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class PesananController extends Controller
{
    public function updatetocart(Request $request) {
        $prod_id = $request->input('produk_id');
        $newQuantity = $request->input('quantity');

        $produk = Produk::where('id_produk',$prod_id)->first();
        // dd($produk);
        // DB::table('pesanandetails')->where('produk_id', $prod_id)->update([
        //     'jumlah' => $newQuantity,
        //     'jumlah_harga' => $produk->harga * $newQuantity,
        // ]);

        $detailPesanan = DetailPesanan::where('produk_id', $prod_id)->firstOrFail();
        $detailPesanan->jumlah = $newQuantity;
        $detailPesanan->jumlah_harga = $produk->harga * $newQuantity;
        $detailPesanan->save();

        // $cartItem = Cart::where('product_id', $productId)->firstOrFail();
        // $cartItem->quantity = $newQuantity;
        // $cartItem->save();

        return response()->json([
            'gtprice' => $produk->harga * $newQuantity,
        ]);
    }

    public function tambahkeranjang(Request $request,$id){
        $produk = Produk::where('id_produk',$id);
        $tanggal = Carbon::now();

        $pesanan = new Pesanan;
        $pesanan->user_id = Auth::user()->id;
        $pesanan->tanggal = $tanggal;
        $pesanan->status = "0";
        $pesanan->jumlah_harga = 0;
        $pesanan->save();

        $pesanan_baru = Pesanan::where('user_id',Auth::user()->id)->where('status',0)->first();

        $pesanan_detail = new DetailPesanan();
        $pesanan_detail->produk_id = $produk->id;
        $pesanan_detail->pesanan_id = $pesanan_baru->id;
        $pesanan_detail-> jumlah = $request->jumlah;
        $pesanan_detail->jumlah_harga = $produk->harga*$request->jumlah;
        $pesanan_detail->save();

        return redirect()->route("pembeli.detailproduk");
    }

    public function keranjang(Request $request,$id){
        $produk = Produk::where('id_produk',$id)->first();
        $tanggal = Carbon::now();

        if($request->jumlah > $produk->jumlah_produk){
            return redirect('detail-produk/'.$id);
        }

        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

        if(empty($cek_pesanan)){
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = "0";
            $pesanan->jumlah_harga = 0;
            $pesanan->save();
        }

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();

        $cek_pesanan_detail = DetailPesanan::where('produk_id', $produk->id_produk)->where('pesanan_id',$pesanan_baru->id)->first();

        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new DetailPesanan();
            $pesanan_detail->produk_id = $produk->id_produk;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail-> jumlah = $request->jumlah;
            $pesanan_detail->jumlah_harga = $produk->harga*$request->jumlah;
            $pesanan_detail->save();
        }else{
            $pesanan_detail = DetailPesanan::where('produk_id', $produk->id_produk)->where('pesanan_id',$pesanan_baru->id)->first();
            $jumlah_pesanan_detail_baru = $request->jumlah;
            $pesanan_detail->jumlah = $pesanan_detail->jumlah + $jumlah_pesanan_detail_baru;
            $harga_pesanan_detail_baru = $produk->harga*$request->jumlah;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga+$harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$produk->harga*$request->jumlah;
        $pesanan->update();


        // $jumlah_pro = $produk->jumlah_produk - $request->jumlah;
        // $produk->update(['jumlah_produk'=>$jumlah_pro]);

        return redirect()->route("pembeli.viewproduk");
    }

    public function vkeranjang(){
        // get user id
        $pengguna_prof = User::where('id', Auth::user()->id)->get();

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        if(empty($pesanan_baru)){
            return redirect()->route('frontend.dashboard-pembeli');
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count("id") as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
            $pesanan_harga = DetailPesanan::select(DB::raw('SUM(jumlah_harga) as totalh'))->where('pesanan_id',$pesanan_baru->id)->get();
            $pesanan_detail = DB::table('pesanandetails')
            ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
            ->where('pesanan_id',$pesanan_baru->id)
            ->where('produk.status_produk','Aktif')
            ->get();
        }
        $total = DetailPesanan::select(DB::raw('sum(jumlah) as total'))->get();
        // return $pesanan_detail;
        // dd($total);
        return view('pembeli.keranjang',[
            'pesanan'=>$pesanan,
            'pesanan_baru'=> $pesanan_baru,
            'pesanan_harga'=>$pesanan_harga,
            'pesanan_detail'=>$pesanan_detail,
            'total'=> $total,
            'pengguna_prof'=>$pengguna_prof
        ]);
    }

    public function hapuskeranjang($id){
        $pesanan = DetailPesanan::find($id);
        $pesanan->delete();

        return redirect()->route('pembeli.keranjang');
    }
}
?>
