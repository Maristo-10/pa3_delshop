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
use App\Notifications\OrderNotification;

class PesananController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function updatetocart(Request $request)
    {
        $prod_id = $request->input('produk_id');
        $newQuantity = $request->input('quantity');

        $produk = Produk::where('id_produk', $prod_id)->first();
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
    public function tambahkeranjang(Request $request, $id)
    {
        $produk = Produk::where('id_produk', $id);
        $tanggal = Carbon::now();
        $now = Carbon::now()->format('dMY');

        $pesanan = new Pesanan;
        $pesanan->user_id = Auth::user()->id;
        $pesanan->tanggal = $tanggal;
        $pesanan->total_harga = 0;

        $pesanan->save();

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();


        $pesanan_detail = new DetailPesanan();
        $pesanan_detail->produk_id = $produk->id;
        $pesanan_detail->pesanan_id = $pesanan_baru->id;
        $pesanan_detail->jumlah = $request->jumlah;
        $pesanan_detail->jumlah_harga = $produk->harga * $request->jumlah;
        $pesanan_detail->save();

        return redirect()->route("pembeli.detailproduk");
    }

    public function keranjang(Request $request, $id)
    {
        $produk = Produk::where('id_produk', $id)->first();
        $tanggal = Carbon::now();
        $now = Carbon::now()->format('dmY');

        if ($request->jumlah > $produk->jumlah_produk) {
            return redirect('detail-produk/' . $id);
        }

        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();

        if (empty($cek_pesanan)) {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->total_harga = 0;
            $pesanan->save();
        }

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pesanan_baru->update([
            'kode' => "DEL$now$pesanan_baru->id"
        ]);
        $cek_pesanan_detail = DetailPesanan::where('produk_id', $produk->id_produk)->where('pesanan_id', $pesanan_baru->id)->where('warna_produk', $request->warna)->where('angkatans', $request->angkatan)->where('ukurans', $request->ukuran)->first();
        if ($cek_pesanan_detail == null) {
            $pesanan_detail = new DetailPesanan();
            $pesanan_detail->produk_id = $produk->id_produk;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah;
            $pesanan_detail->jumlah_harga = $produk->harga * $request->jumlah;
            $pesanan_detail->ukurans = $request->ukuran;
            $pesanan_detail->warna_produk = $request->warna;
            $pesanan_detail->angkatans = $request->angkatan;
            $pesanan_detail->save();
        }
        if ($cek_pesanan_detail != null) {
            $pesanan_detail = DetailPesanan::where('produk_id', $produk->id_produk)->where('pesanan_id', $pesanan_baru->id)->where('warna_produk', $request->warna)->where('angkatans', $request->angkatan)->where('ukurans', $request->ukuran)->first();
            $jumlah_pesanan_detail_baru = $request->jumlah;
            $pesanan_detail->jumlah = $pesanan_detail->jumlah + $jumlah_pesanan_detail_baru;
            $harga_pesanan_detail_baru = $produk->harga * $request->jumlah;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pesanan->total_harga = $pesanan->total_harga + $produk->harga * $request->jumlah;
        $pesanan->update();
        return redirect()->route("pembeli.viewproduk");
    }

    public function vkeranjang()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pesanan_c = Pesanan::where('user_id', Auth::user()->id)->where('status', 'checkout')->first();
        if (empty($pesanan_c)) {
            $d_pesanan = null;
        }
        if (!empty($pesanan_c)) {
            $d_pesanan = DB::table('pesanandetails')->join('pesanans', 'pesanans.id', '=', 'pesanandetails.pesanan_id')->where('pesanandetails.pesanan_id', $pesanan_c->id)->first();
        }

        $b_pesanan = DB::table('pesanandetails')->join('pesanans', 'pesanans.id', '=', 'pesanandetails.pesanan_id')->where('pesanandetails.pesanan_id', $pesanan_baru->id)->orwhere('pesanandetails.pesanan_id', $pesanan_c->id)->first();
        // dd($pesanan_c);
        if ($d_pesanan == null) {
            $detail = 0;
        }
        if ($d_pesanan != null) {
            $detail = 1;
        }
        if ($b_pesanan == null) {

            $lama = 0;
        }
        if ($b_pesanan != null) {
            $lama = 1;
        }

        $pengguna_prof = User::where('id', Auth::user()->id)->get();

        if (empty($pesanan_baru)) {
            $pesanan = 0;
            return redirect()->route('frontend.dashboard-pembeli');
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count("id") as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
            $pesanan_harga = DetailPesanan::select(DB::raw('SUM(jumlah_harga) as totalh'))->where('pesanan_id', $pesanan_baru->id)->get();
            $pesanan_detail = DB::table('pesanandetails')
                ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
                ->where('pesanan_id', $pesanan_baru->id)
                ->orWhere('pesanan_id', $pesanan_c->id)
                ->where('produk.status_produk', 'Aktif')
                ->get();
        }
        $total = DetailPesanan::select(DB::raw('sum(jumlah) as total'))->get();
        // return $pesanan_detail;
        return view('pembeli.keranjang', [
            'pesanan' => $pesanan,
            'pesanan_baru' => $pesanan_baru,
            'pesanan_harga' => $pesanan_harga,
            'pesanan_detail' => $pesanan_detail,
            'total' => $total,
            'pengguna_prof' => $pengguna_prof,
            'pesanan_c' => $pesanan_c,
            'detail' => $detail,
            'lama' => $lama
        ]);
    }

    public function hapuskeranjang($id)
    {
        $pesanan = DetailPesanan::find($id);
        $pesanan_baru = Pesanan::where('id', $pesanan->pesanan_id)->first();
        $harga_pesanan = $pesanan_baru->total_harga;
        $harga_detail = $pesanan->jumlah_harga;
        $harga_akhir = $harga_pesanan - $harga_detail;
        $pesanan_baru->total_harga = $harga_akhir;
        $pesanan_baru->save();
        $pesanan->delete();


        return redirect()->route('pembeli.keranjang');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vcheckout()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'checkout')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }

        $pesanan = DetailPesanan::select(DB::raw('count("id") as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        $pesanan_harga = DetailPesanan::select(DB::raw('SUM(jumlah_harga) as totalh'))->where('pesanan_id', $pesanan_baru->id)->get();
        $pesanan_detail = DB::table('pesanandetails')
            ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
            ->where('pesanan_id', $pesanan_baru->id)
            ->where('produk.status_produk', 'Aktif')
            ->get();
        $total = DetailPesanan::select(DB::raw('sum(jumlah) as total'))->get();
        $metpem = MetodePembayaran::all();
        $kapem = KategoriPembayaran::all();

        return view('pembeli.checkout', [
            'pesanan_baru' => $pesanan_baru,
            'pesanan' => $pesanan,
            'pengguna_prof' => $pengguna_prof,
            'pesanan_harga' => $pesanan_harga,
            'pesanan_detail' => $pesanan_detail,
            'total' => $total,
            'metpem' => $metpem,
            'kapem' => $kapem
        ]);
    }


    public function pcheckout(Request $request)
    {
        $arrName = [];
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'checkout')->first();
        $tanggal = Carbon::now();
        if ($request->file('bukti_pembayaran')) {
            if ($request->hasfile('bukti_pembayaran')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bukti_pembayaran')->getClientOriginalName());
                $request->file('bukti_pembayaran')->move(public_path('pembayaran-images'), $filename);
                $pesanan_baru->update(['bukti_pembayaran' => $filename]);
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        // $jumlah_pro = $produk->jumlah_produk - $request->jumlah;
        // $produk->update(['jumlah_produk'=>$jumlah_pro]);
        if ($request->kategori_pembayaran == 901) {
            $pesanan_baru->update([
                'status' => 'Ditangguhkan',
                'nama_pengambil' => $request->nama_pengambil,
                'metode_pembayaran' => $request->kategori_pembayaran,
                'nama_layanan' => $request->metode_pembayaran,
                'tanggal' => $tanggal
            ]);
        } else {
            $pesanan_baru->update([
                'status' => 'Sedang Diproses',
                'nama_pengambil' => $request->nama_pengambil,
                'metode_pembayaran' => $request->kategori_pembayaran,
                'nama_layanan' => $request->metode_pembayaran,
                'tanggal' => $tanggal
            ]);
        }

        User::find(Auth::user()->id)->notify(new OrderNotification("Sedang Diproses", $pesanan_baru->id, $pesanan_baru->kode));
        return redirect()->route('frontend.dashboard-pembeli');
    }

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->route('frontend.dashboard-pembeli');
    }

    public function markAsReadByID($id)
    {
        DB::table('notifications')
            ->where('id', $id)
            ->update(['read_at' => now()]);

        return redirect()->route('frontend.dashboard-pembeli');
    }

    public function vpesanan()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }

        $pesanan_kapem = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('pesanans.user_id', Auth::user()->id)
            ->where('status', '!=', 'keranjang')
            ->where('status', '!=', 'checkout')
            ->get();

        $jumlah = Pesanan::select(DB::raw('Cast(Count(id) as int) as total'))->where('pesanans.user_id', Auth::user()->id)->where('status', '!=', 'keranjang')->first();

        return view('pembeli.pesanan', [
            'pengguna_prof' => $pengguna_prof,
            'pesanan_baru' => $pesanan_baru,
            'pesanan' => $pesanan,
            'pesanan_kapem' => $pesanan_kapem,
            'jumlah' => $jumlah
        ]);
    }

    public function detail_pesanan($id)
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }

        $harga = Pesanan::where('id', $id)->first();
        $pembayaran = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('id', $id)
            ->get();

        $detail_pesanan = DB::table('pesanandetails')
            ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
            ->join('pesanans', 'pesanans.id', '=', 'pesanandetails.pesanan_id')
            ->where('pesanan_id', $id)
            ->get();

        $jumlah_pesanan = DB::table('pesanandetails')
            ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
            ->join('pesanans', 'pesanans.id', '=', 'pesanandetails.pesanan_id')
            ->where('pesanan_id', $id)
            ->select(DB::raw('SUM(pesanandetails.jumlah) as total'))
            ->groupBy("pesanandetails.pesanan_id")
            ->first();
        return view('pembeli.detailpesanan', [
            'pengguna_prof' => $pengguna_prof,
            'pesanan_baru' => $pesanan_baru,
            'pesanan' => $pesanan,
            'harga' => $harga,
            'detail_pesanan' => $detail_pesanan,
            'pembayaran' => $pembayaran,
            'jumlah_pesanan' => $jumlah_pesanan
        ]);
    }

    public function kelolapesanan()
    {
        $pengguna_prof = User::where('id', Auth::user()->id)->get();

        $pesanan_kapem = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('status', '!=', 'keranjang')
            ->where('status', '!=', 'checkout')
            ->paginate(5);

        return view('admin.kelolapesanan', [
            'pengguna_prof' => $pengguna_prof,
            'pesanan_kapem' => $pesanan_kapem
        ]);
    }

    public function detailpesanan($id)
    {
        $pengguna_prof = User::where('id', Auth::user()->id)->get();

        $harga = Pesanan::where('id', $id)->first();
        $pembayaran = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('id', $id)
            ->get();

        $detail_pesanan = DB::table('pesanandetails')
            ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
            ->join('pesanans', 'pesanans.id', '=', 'pesanandetails.pesanan_id')
            ->where('pesanan_id', $id)
            ->get();

        $jumlah_pesanan = DB::table('pesanandetails')
            ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
            ->join('pesanans', 'pesanans.id', '=', 'pesanandetails.pesanan_id')
            ->where('pesanan_id', $id)
            ->select(DB::raw('SUM(pesanandetails.jumlah) as total'))
            ->groupBy("pesanandetails.pesanan_id")
            ->first();

        return view('admin.detailpesanan', [
            'pengguna_prof' => $pengguna_prof,
            'harga' => $harga,
            'detail_pesanan' => $detail_pesanan,
            'pembayaran' => $pembayaran,
            'jumlah_pesanan' => $jumlah_pesanan
        ]);
    }
    public function ubahstatus($id)
    {
        $pengguna_prof = User::where('id', Auth::user()->id)->get();

        $harga = Pesanan::where('id', $id)->first();
        $pembayaran = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('id', $id)
            ->get();

        $detail_pesanan = DB::table('pesanandetails')
            ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
            ->join('pesanans', 'pesanans.id', '=', 'pesanandetails.pesanan_id')
            ->where('pesanan_id', $id)
            ->get();

        $jumlah_pesanan = DB::table('pesanandetails')
            ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
            ->join('pesanans', 'pesanans.id', '=', 'pesanandetails.pesanan_id')
            ->where('pesanan_id', $id)
            ->select(DB::raw('SUM(pesanandetails.jumlah) as total'))
            ->groupBy("pesanandetails.pesanan_id")
            ->first();

        return view('admin.ubahstatus', [
            'pengguna_prof' => $pengguna_prof,
            'harga' => $harga,
            'detail_pesanan' => $detail_pesanan,
            'pembayaran' => $pembayaran,
            'jumlah_pesanan' => $jumlah_pesanan
        ]);
    }

    public function updatestatus(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        $detailspesanan = DetailPesanan::where("pesanan_id", $pesanan->id)->first();
        $produk = Produk::where('id_produk', $detailspesanan->produk_id)->first();
        // dd($pesanan);
        $status = $request->status;
        $pesanan->update([
            'status' => $request->status,
        ]);

        // $user = $pesanan->user_id;
        User::find($pesanan->user_id)->notify(new OrderNotification($status, $pesanan->id, $pesanan->kode));
        return redirect()->route('admin.kelolapesanan');
    }

    public function ditangguhkan()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $pesanan_kapem = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('pesanans.user_id', Auth::user()->id)
            ->where('status', 'Ditangguhkan')
            ->paginate(5);
        $jumlah = Pesanan::select(DB::raw('Cast(Count(id) as int) as total'))->where('pesanans.user_id', Auth::user()->id)->where('status', 'Ditangguhkan')->first();
        return view('pembeli.pesanan', [
            'pengguna_prof' => $pengguna_prof,
            'pesanan_baru' => $pesanan_baru,
            'pesanan' => $pesanan,
            'pesanan_kapem' => $pesanan_kapem,
            'jumlah' => $jumlah
        ]);
    }

    public function belumDiambil()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $pesanan_kapem = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('pesanans.user_id', Auth::user()->id)
            ->where('status', 'Siap Diambil')
            ->paginate(5);
        $jumlah = Pesanan::select(DB::raw('Cast(Count(id) as int) as total'))->where('pesanans.user_id', Auth::user()->id)->where('status', 'Siap Diambil')->first();
        return view('pembeli.pesanan', [
            'pengguna_prof' => $pengguna_prof,
            'pesanan_baru' => $pesanan_baru,
            'pesanan' => $pesanan,
            'pesanan_kapem' => $pesanan_kapem,
            'jumlah' => $jumlah
        ]);
    }

    public function selesai()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $pesanan_kapem = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('pesanans.user_id', Auth::user()->id)
            ->where('status', 'Selesai')
            ->paginate(5);
        $jumlah = Pesanan::select(DB::raw('Cast(Count(id) as int) as total'))->where('pesanans.user_id', Auth::user()->id)->where('status', 'Selesai')->first();
        return view('pembeli.pesanan', [
            'pengguna_prof' => $pengguna_prof,
            'pesanan_baru' => $pesanan_baru,
            'pesanan' => $pesanan,
            'pesanan_kapem' => $pesanan_kapem,
            'jumlah' => $jumlah
        ]);
    }

    public function diproses()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $pesanan_kapem = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('pesanans.user_id', Auth::user()->id)
            ->where('status', 'Sedang Diproses')
            ->paginate(5);
        $jumlah = Pesanan::select(DB::raw('Cast(Count(id) as int) as total'))->where('pesanans.user_id', Auth::user()->id)->where('status', 'Sedang Diproses')->first();
        return view('pembeli.pesanan', [
            'pengguna_prof' => $pengguna_prof,
            'pesanan_baru' => $pesanan_baru,
            'pesanan' => $pesanan,
            'pesanan_kapem' => $pesanan_kapem,
            'jumlah' => $jumlah
        ]);
    }

    public function dibatalkan()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $pesanan_kapem = DB::table('pesanans')
            ->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')
            ->where('pesanans.user_id', Auth::user()->id)
            ->where('status', 'Dibatalkan')
            ->paginate(5);
        $jumlah = Pesanan::select(DB::raw('Cast(Count(id) as int) as total'))->where('pesanans.user_id', Auth::user()->id)->where('status', 'Dibatalkan')->first();
        return view('pembeli.pesanan', [
            'pengguna_prof' => $pengguna_prof,
            'pesanan_baru' => $pesanan_baru,
            'pesanan' => $pesanan,
            'pesanan_kapem' => $pesanan_kapem,
            'jumlah' => $jumlah
        ]);
    }

    public function updatebatalkan($id)
    {

        $pesanan = Pesanan::find($id);
        $pesanan->update([
            'status' => 'Dibatalkan',
        ]);

        return redirect()->route('admin.kelolapesanan');
    }

    public function laporanpenjualanCustom(Request $request)
    {
        $tahunl = $request->tahun_laporan;
        $month = $request->bulan_laporan;
        $year = Carbon::now()->format('Y');
        $awal = $request->tanggal_awal;
        $akhir = $request->tanggal_akhir;
        $penjualan = DB::table('pesanans')->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
            ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->where('pesanans.status', 'Selesai')->get();
        $jumlah = Pesanan::select(DB::raw('CAST(count(id) as int) as total'))->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->where('pesanans.status', 'Selesai')->first();
        $jlh_pesanan = DB::table('pesanans')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->select(DB::raw('CAST(SUM(pesanandetails.jumlah) as int) as total'))->whereBetween('pesanans.tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->where('pesanans.status', 'Selesai')->first();
        $total_harga = DB::table('pesanans')->select(DB::raw('sum(total_harga) as total'))->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->where('status', 'Selesai')->first();
        return view('admin.laporanpenjualan', [
            'penjualan' => $penjualan,
            'jlh_pesanan' => $jlh_pesanan,
            'total_harga' => $total_harga,
            'awal' => $awal,
            'akhir' => $akhir,
            'year' => $year,
            'month' => $month,
            'tahunl' => $tahunl,
            'jumlah' => $jumlah
        ]);
    }

    public function laporanpenjualanBulanan(Request $request)
    {
        $tahunl = $request->tahun_laporan;
        $year = Carbon::now()->format('Y');
        $awal = $request->tanggal_awal;
        $akhir = $request->tanggal_akhir;
        $month = $request->bulan_laporan;
        $date = Carbon::createFromFormat('Y-m', $month);
        $bulan = $date->format('m');
        $tahun = $date->format('Y');
        $penjualan = DB::table('pesanans')->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
            ->WhereMonth('tanggal', '=', $bulan)->whereYear('tanggal', '=', $tahun)->where('pesanans.status', 'Selesai')->get();
        $jumlah = Pesanan::select(DB::raw('CAST(count(id) as int) as total'))->WhereMonth('tanggal', '=', $bulan)->whereYear('tanggal', '=', $tahun)->where('pesanans.status', 'Selesai')->first();
        $jlh_pesanan = DB::table('pesanans')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->select(DB::raw('SUM(pesanandetails.jumlah) as total'))->WhereMonth('tanggal', '=', $bulan)->whereYear('tanggal', '=', $tahun)->where('pesanans.status', 'Selesai')->first();
        $total_harga = DB::table('pesanans')->select(DB::raw('sum(total_harga) as total'))->WhereMonth('tanggal', '=', $bulan)->whereYear('tanggal', '=', $tahun)->where('status', 'Selesai')->first();
        return view('admin.laporanpenjualan', [
            'penjualan' => $penjualan,
            'jlh_pesanan' => $jlh_pesanan,
            'total_harga' => $total_harga,
            'awal' => $awal,
            'akhir' => $akhir,
            'year' => $year,
            'month' => $month,
            'tahunl' => $tahunl,
            'jumlah' => $jumlah
        ]);
    }

    public function laporanpenjualanTahunan(Request $request)
    {
        $year = Carbon::now()->format('Y');
        $awal = $request->tanggal_awal;
        $akhir = $request->tanggal_akhir;
        $month = $request->bulan_laporan;
        $tahunl = $request->tahun_laporan;
        $penjualan = DB::table('pesanans')->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')
            ->whereYear('tanggal', $tahunl)->where('pesanans.status', '!=', 'keranjang')->where('pesanans.status', 'Selesai')->get();
        $jlh_pesanan = DB::table('pesanans')->join('pesanandetails', 'pesanandetails.pesanan_id', '=', 'pesanans.id')->select(DB::raw('SUM(pesanandetails.jumlah) as total'))->where('pesanans.status', '!=', 'keranjang')->whereYear('tanggal', $tahunl)->where('pesanans.status', 'Selesai')->first();
        $jumlah = Pesanan::select(DB::raw('CAST(count(id) as int) as total'))->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->where('pesanans.status', 'Selesai')->first();
        $total_harga = DB::table('pesanans')->select(DB::raw('sum(total_harga) as total'))->where('pesanans.status', '!=', 'keranjang')->whereYear('tanggal', $tahunl)->where('status', 'Selesai')->first();
        return view('admin.laporanpenjualan', [
            'penjualan' => $penjualan,
            'jlh_pesanan' => $jlh_pesanan,
            'total_harga' => $total_harga,
            'awal' => $awal,
            'akhir' => $akhir,
            'year' => $year,
            'month' => $month,
            'tahunl' => $tahunl,
            'jumlah' => $jumlah
        ]);
    }

    public function addCh(Request $request, $id)
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pesanan_detail = DetailPesanan::where('id', $id)->where('pesanan_id', $pesanan_baru->id)->first();

        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 'checkout')->first();

        $tanggal = Carbon::now();
        $now = Carbon::now()->format('dmY');

        if (empty($cek_pesanan)) {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->total_harga = 0;
            $pesanan->status = 'checkout';
            $pesanan->save();
        }

        $pes = Pesanan::where('user_id', Auth::user()->id)->where('status', 'checkout')->first();

        $harga = $pesanan_baru->total_harga - $pesanan_detail->jumlah_harga;
        $pesanan_baru->total_harga = $harga;
        $pesanan_baru->update([
            'total_harga' => $harga
        ]);
        $pesanan_detail_baru = DetailPesanan::where('pesanan_id', $pes->id)->where('produk_id', $pesanan_detail->produk_id)->where('ukurans', $pesanan_detail->ukurans)->where('warna_produk', $pesanan_detail->warna_produk)->where('angkatans', $pesanan_detail->angkatans)->first();
        if (empty($pesanan_detail_baru)) {
            $pesanan_detail->pesanan_id = $pes->id;
            $pesanan_detail->update();
            $produk = DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')->where('pesanandetails.id', $id)->first();
            $stok = $produk->jumlah_produk - $pesanan_detail->jumlah;
        }

        if (!empty($pesanan_detail_baru)) {
            $pesanan_detail_baru = DetailPesanan::where('produk_id', $pesanan_detail->produk_id)->where('pesanan_id', $pes->id)->where('ukurans', $pesanan_detail->ukurans)->where('warna_produk', $pesanan_detail->warna_produk)->where('angkatans', $pesanan_detail->angkatans)->first();
            $pesanan_detail_baru->jumlah = $pesanan_detail->jumlah + $pesanan_detail_baru->jumlah;
            $pesanan_detail_baru->jumlah_harga = $pesanan_detail->jumlah_harga + $pesanan_detail_baru->jumlah_harga;
            $pesanan_detail_baru->update();
            $produk = DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')->where('pesanandetails.id', $id)->first();
            $stok = $produk->jumlah_produk - $pesanan_detail->jumlah;
            $pesanan_detail->delete();
        }



        $pro = Produk::where('id_produk', $produk->id_produk)->first();
        $pro->update([
            'jumlah_produk' => $stok,
        ]);

        $pes->kode = "DEL$now$pes->id";
        $pes->update();
        // $cek_pesanan_detail = DetailPesanan::where('id', $id)->where('pesanan_id', $cek_pesanan->id)->first();



        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 'checkout')->first();
        $pesanan->total_harga = $pesanan->total_harga + $produk->harga * $request->jumlah;
        $pesanan->update();
        return redirect()->route('pembeli.keranjang');
    }

    public function backKer($id)
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'checkout')->first();
        $pesanan_lama = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pesanan_detail = DetailPesanan::where('id', $id)->where('pesanan_id', $pesanan_baru->id)->first();

        $tanggal = Carbon::now();
        $now = Carbon::now()->format('dmY');

        $produk = DB::table('produk')->join('pesanandetails', 'pesanandetails.produk_id', '=', 'produk.id_produk')->where('pesanandetails.id', $id)->first();
        $pro = Produk::where('id_produk', $produk->id_produk)->first();
        $stok = $produk->jumlah_produk + $pesanan_detail->jumlah;
        $pro->update([
            'jumlah_produk' => $stok
        ]);

        $pesanan_detail_lama = DetailPesanan::where('produk_id', $pesanan_detail->produk_id)->where('pesanan_id', $pesanan_lama->id)->where('ukurans', $pesanan_detail->ukurans)->where('warna_produk', $pesanan_detail->warna_produk)->where('angkatans', $pesanan_detail->angkatans)->first();
        if (empty($pesanan_detail_lama)) {
            $pesanan_detail->pesanan_id = $pesanan_lama->id;
            $pesanan_detail->update();
        }

        if (!empty($pesanan_detail_lama)) {
            $pesanan_detail_lama->jumlah = $pesanan_detail_lama->jumlah + $pesanan_detail->jumlah;
            $pesanan_detail_lama->jumlah_harga = $pesanan_detail_lama->jumlah_harga + $pesanan_detail->jumlah_harga;
            $pesanan_detail_lama->update();
            $pesanan_detail->delete();
        }



        $harga = $pesanan_baru->total_harga - $pesanan_detail->jumlah_harga;
        $pesanan_baru->total_harga = $harga;
        $pesanan_baru->update();

        $harga_remove = $pesanan_lama->total_harga + $pesanan_detail->jumlah_harga;
        $pesanan_lama->total_harga =  $harga_remove;
        $pesanan_lama->kode = "DEL$now$pesanan_lama->id";
        $pesanan_lama->update();

        return redirect()->route('pembeli.checkout');
    }

    public function cariPesanan(Request $request)
    {
        $cari = $request->sidPes;

        $pesanan_kapem = DB::table('pesanans')->where('kode', $cari)->join('kategoripembayarans', 'kategoripembayarans.id_kapem', '=', 'pesanans.metode_pembayaran')
            ->join('metodepembayarans', 'metodepembayarans.id_metpem', '=', 'pesanans.nama_layanan')->paginate(5);

        return view('admin.kelolapesanan', [
            'pesanan_kapem' => $pesanan_kapem
        ]);
    }
}
