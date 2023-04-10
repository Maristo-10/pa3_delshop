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
use App\Models\MetodePembayaran;
use App\Models\KategoriPembayaran;


class PesananController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


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
        $pesanan->jumlah_harga = 0;

        $pesanan->save();

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();

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

        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();

        if(empty($cek_pesanan)){
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->jumlah_harga = 0;
            $pesanan->save();
        }

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();

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

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$produk->harga*$request->jumlah;
        $pesanan->update();




        return redirect()->route("pembeli.viewproduk");
    }

    public function vkeranjang(){
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vcheckout(){
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }
        $pesanan = DetailPesanan::select(DB::raw('count("id") as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        $pesanan_harga = DetailPesanan::select(DB::raw('SUM(jumlah_harga) as totalh'))->where('pesanan_id',$pesanan_baru->id)->get();
        $pesanan_detail = DB::table('pesanandetails')
        ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
        ->where('pesanan_id',$pesanan_baru->id)
        ->where('produk.status_produk','Aktif')
        ->get();
        $total = DetailPesanan::select(DB::raw('sum(jumlah) as total'))->get();
        $metpem = MetodePembayaran::all();
        $kapem = KategoriPembayaran::all();

        return view('pembeli.checkout',[
            'pesanan_baru'=> $pesanan_baru,
            'pesanan'=>$pesanan,
            'pengguna_prof'=>$pengguna_prof,
            'pesanan_harga'=>$pesanan_harga,
            'pesanan_detail'=>$pesanan_detail,
            'total'=> $total,
            'metpem'=>$metpem,
            'kapem'=>$kapem
        ]);
    }


    public function pcheckout(Request $request){
        $arrName = [];
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        if($request->file('bukti_pembayaran')){
            if ($request->hasfile('bukti_pembayaran')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('bukti_pembayaran')->getClientOriginalName());
                $request->file('bukti_pembayaran')->move(public_path('pembayaran-images'), $filename);
                $pesanan_baru->update(['bukti_pembayaran'=>$filename]);
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        // $jumlah_pro = $produk->jumlah_produk - $request->jumlah;
        // $produk->update(['jumlah_produk'=>$jumlah_pro]);
        $pesanan_baru->update([
            'status'=>'Sedang Diproses',
            'nama_pengambil'=>$request->nama_pengambil,
            'metode_pembayaran'=>$request->kategori_pembayaran,
            'id_layanan'=>$request->metode_pembayaran

        ]);

        return redirect()->route('frontend.dashboard-pembeli');
    }

    public function vpesanan(){
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }

        $pesanan_kapem = DB::table('pesanans')
        ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
        ->join('metodepembayarans','metodepembayarans.id_metpem', '=' ,'pesanans.id_layanan')
        ->where('pesanans.user_id', Auth::user()->id)
        ->where('status','!=','keranjang')
        ->get();


        return view('pembeli.pesanan',[
            'pengguna_prof'=>$pengguna_prof,
            'pesanan_baru'=>$pesanan_baru,
            'pesanan'=>$pesanan,
            'pesanan_kapem'=>$pesanan_kapem
        ]);
    }

    public function detail_pesanan($id){
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }

        $harga = Pesanan::where('id',$id)->first();
        $pembayaran = DB::table('pesanans')
        ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
        ->join('metodepembayarans','metodepembayarans.id_metpem', '=' ,'pesanans.id_layanan')
        ->where('id', $id)
        ->get();

        $detail_pesanan = DB::table('pesanandetails')
        ->join('produk','produk.id_produk','=','pesanandetails.produk_id')
        ->where('pesanan_id',$id)
        ->get();

        return view('pembeli.detailpesanan',[
            'pengguna_prof'=>$pengguna_prof,
            'pesanan_baru'=>$pesanan_baru,
            'pesanan'=>$pesanan,
            'harga'=>$harga,
            'detail_pesanan'=>$detail_pesanan,
            'pembayaran'=>$pembayaran
        ]);
    }

    public function kelolapesanan(){

        $pengguna_prof = User::where('id', Auth::user()->id)->get();

        $pesanan_kapem = DB::table('pesanans')
        ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
        ->join('metodepembayarans','metodepembayarans.id_metpem', '=' ,'pesanans.id_layanan')
        ->where('status','!=','keranjang')
        ->get();


        return view('admin.kelolapesanan',[
            'pengguna_prof'=>$pengguna_prof,
            'pesanan_kapem'=>$pesanan_kapem
        ]);
    }

    public function detailpesanan($id){
        $pengguna_prof = User::where('id', Auth::user()->id)->get();

        $harga = Pesanan::where('id',$id)->first();
        $pembayaran = DB::table('pesanans')
        ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
        ->join('metodepembayarans','metodepembayarans.id_metpem', '=' ,'pesanans.id_layanan')
        ->where('id', $id)
        ->get();

        $detail_pesanan = DB::table('pesanandetails')
        ->join('produk','produk.id_produk','=','pesanandetails.produk_id')
        ->where('pesanan_id',$id)
        ->get();

        return view('admin.detailpesanan',[
            'pengguna_prof'=>$pengguna_prof,
            'harga'=>$harga,
            'detail_pesanan'=>$detail_pesanan,
            'pembayaran'=>$pembayaran
        ]);
    }

    public function ditangguhkan(){
        $pesanan_kapem = DB::table('pesanans')
        ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
        ->join('metodepembayarans','metodepembayarans.id_metpem', '=' ,'pesanans.id_layanan')
        ->where('pesanans.user_id', Auth::user()->id)
        ->where('status', 'Belum Dibayar')
        ->get();
        return response()->json($pesanan_kapem);
    }

    public function belumDiambil(){
        $pesanan_kapem = DB::table('pesanans')
        ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
        ->join('metodepembayarans','metodepembayarans.id_metpem', '=' ,'pesanans.id_layanan')
        ->where('pesanans.user_id', Auth::user()->id)
        ->where('status', 'Siap Diambil')
        ->get();
        return response()->json($pesanan_kapem);
    }

    public function selesai(){
        $pesanan_kapem = DB::table('pesanans')
        ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
        ->join('metodepembayarans','metodepembayarans.id_metpem', '=' ,'pesanans.id_layanan')
        ->where('pesanans.user_id', Auth::user()->id)
        ->where('status', 'Selesai')
        ->get();
        return response()->json($pesanan_kapem);
    }

    public function diproses(){
        $pesanan_kapem = DB::table('pesanans')
        ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
        ->join('metodepembayarans','metodepembayarans.id_metpem', '=' ,'pesanans.id_layanan')
        ->where('pesanans.user_id', Auth::user()->id)
        ->where('status', 'Sedang Diproses')
        ->get();
        return response()->json($pesanan_kapem);
    }
}
