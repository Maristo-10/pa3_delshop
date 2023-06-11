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
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function importProduk(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move('ProductsData', $fileName);
        Excel::import(new ProductsImport, \public_path('/ProductsData/' . $fileName));

        return redirect()->route('admin.kelolaproduk')->with('success', 'Data berhasil diimport!');
    }

    public function viewImportProduct()
    {
        return view('admin.tambahprodukimport');
    }

    public function produk()
    {

        $produk = Produk::orderByDesc('id_produk')->paginate(10);

        // $produk = Produk::where('status_produk', 'Aktif')->orderByDesc('id_produk')->paginate(10);

        return view('admin.kelolaproduk', compact('produk'));
    }

    public function cariKelolaProduk(Request $request) {
        $data = $request->cari;
        $produk = Produk::where('nama_produk', 'like', '%' . $data . '%')->paginate(10);

        return view('admin.kelolaproduk', compact('produk'));

    }
    // filter category
    public function filterByCategory($category)
    {
        $products = Produk::where('kategori_produk', $category)->get();

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $kategori = KategoriProdukModel::all();
        $ukuran = UkuranModel::all();
        return view('pembeli.viewproduk', [
            'produk' => $products,
            'ukuran' => $ukuran,
            'kategori' => $kategori,
            'pesanan' => $pesanan,
            'pesanan_baru' => $pesanan_baru,
            'pengguna_prof' => $pengguna_prof
        ]);
    }
    // sorting produk
    public function sorting(Request $request)
    {
        $sort = $request->input('sort');

        $items = Produk::query();
        if ($sort) {
            if ($sort == 'latest') {
                $items->orderBy('created_at', 'desc');
            } elseif ($sort == 'termahal') {
                $items->orderBy('harga', 'desc');
            } elseif ($sort == 'termurah') {
                $items->orderBy('harga', 'asc');
            } elseif ($sort == 'all') {
                $items = $items;
            }
        }
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }
        $kategori = KategoriProdukModel::all();
        $produk = $items->get();
        $ukuran = UkuranModel::all();
        return view('pembeli.viewproduk', [
            'produk' => $produk,
            'ukuran' => $ukuran,
            'kategori' => $kategori,
            'pesanan' => $pesanan,
            'pesanan_baru' => $pesanan_baru,
            'pengguna_prof' => $pengguna_prof
        ]);
    }

    public function viewtambahproduk()
    {
        $kategori_produk = KategoriProdukModel::all();
        $role = Role::all()->where('kategori_role', 'Pembeli');
        $ukuran = UkuranModel::all();
        $now = Carbon::now(); // Mendapatkan waktu saat ini
        $currentYear = $now->format('Y');
        $fiveYearsAgo = $now->subYears(6); // Mengurangi 5 tahun dari waktu saat ini

        // Menggunakan format 'Y' untuk mendapatkan tahun

        $fiveYearsAgoYear = $fiveYearsAgo->format('Y');

        // Menggunakan rentang tahun dari 5 tahun yang lalu hingga tahun saat ini
        $years = range($fiveYearsAgoYear, $currentYear);

        return view('admin.tambahproduk', [
            'kategori_produk' => $kategori_produk,
            'role' => $role,
            'ukuran' => $ukuran,
            'fiveYearsAgoYear' => $fiveYearsAgoYear,
            'currentYear' => $currentYear
        ]);
    }

    public function tambahproduk(Request $request)
    {
        $arrName = [];
        $id = $request->id;

        $validatedData = $request->validate([
            'gambar_produk' => 'image|file|max:10000'
        ]);

        // dd($options);

        $tambahproduk = new Produk();
        $tambahproduk->nama_produk = $request->nama_produk;
        $tambahproduk->harga = $request->harga;
        $tambahproduk->jumlah_produk = $request->jumlah_produk;
        $tambahproduk->role_pembeli = $request->role_pembeli;
        $tambahproduk->kategori_produk = $request->kategori_produk;
        $tambahproduk->produk_unggulan = $request->produk_unggulan;
        $tambahproduk->deskripsi = $request->deskripsi;
        if ($request->input('ukuran') != null) {
            $selectedUkuran = implode(',', $request->input('ukuran'));
            $tambahproduk->ukuran_produk = $selectedUkuran;
        }
        if ($request->input('warna') != null) {
            $selectedWarna = implode(',', $request->input('warna'));
            $tambahproduk->warna = $selectedWarna;
        }
        if ($request->input('angkatan') != null) {
            $selectedAngkatan = implode(',', $request->input('angkatan'));
            $tambahproduk->angkatan = $selectedAngkatan;
        }
        // $tambahproduk->ukuran_produk = $options;
        if ($request->file('gambar_produk')) {
            if ($request->hasfile('gambar_produk')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('gambar_produk')->getClientOriginalName());
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

        return redirect()->route("admin.kelolaproduk")->with('success', 'Data Produk Berhasil Di Tambahkan');
    }

    public function viewubahproduk($id)
    {
        $produk = Produk::find($id);
        $kategori_produk = KategoriProdukModel::all();
        $role = Role::all()->where('kategori_role', 'Pembeli');
        $ukuran = UkuranModel::all();
        $now = Carbon::now(); // Mendapatkan waktu saat ini
        $currentYear = $now->format('Y');
        $fiveYearsAgo = $now->subYears(6); // Mengurangi 5 tahun dari waktu saat ini

        // Menggunakan format 'Y' untuk mendapatkan tahun

        $fiveYearsAgoYear = $fiveYearsAgo->format('Y');
        return view('admin.ubahproduk', [
            'produk' => $produk,
            'kategori_produk' => $kategori_produk,
            'role' => $role,
            'ukuran'=> $ukuran,
            'fiveYearsAgoYear' =>$fiveYearsAgoYear,
            'currentYear'=>$currentYear
        ]);
    }

    public function ubahproduk(Request $request, $id)
    {
        $produk = Produk::find($id);

        $nama_produk = $request->nama_produk;
        $harga = $request->harga;
        $jumlah_produk = $request->jumlah_produk;
        $role_pembeli = $request->role_pembeli;
        $kategori_produk = $request->kategori_produk;
        $produk_unggulan = $request->produk_unggulan;
        $deskripsi = $request->deskripsi;
        $ukuran_produk = "";
        $warna = "";
        $angkatan = "";
        if($request->input('ukuran') != null){
            $selectedUkuran = implode(',', $request->input('ukuran'));
            $ukuran_produk = $selectedUkuran;
        }
        if($request->input('warna') != null){
            $selectedWarna = implode(',', $request->input('warna'));
            $warna = $selectedWarna;
        }
        if($request->input('angkatan') != null){
            $selectedAngkatan = implode(',', $request->input('angkatan'));
            $angkatan = $selectedAngkatan;
        }
        if ($request->file('gambar_produk')) {
            if ($request->hasfile('gambar_produk')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('gambar_produk')->getClientOriginalName());
                $request->file('gambar_produk')->move(public_path('product-images'), $filename);
                $produk->update(['gambar_produk' => $filename]);
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        $produk->update([
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'jumlah_produk' => $jumlah_produk,
            'role_pembeli' => $role_pembeli,
            'kategori_produk' => $kategori_produk,
            'produk_unggulan' => $produk_unggulan,
            'deskripsi' => $deskripsi,
            'ukuran_produk' => $ukuran_produk,
            'warna' => $warna,
            'angkatan' => $angkatan
        ]);

        return redirect()->route('admin.kelolaproduk')->with('success', 'Data Produk Berhasil di Ubah');
    }

    public function ubahstatusproduknon($id, Request $request)
    {
        $produk = Produk::find($id);
        $produk->update(['status_produk' => 'Non-Aktif']);

        return redirect()->route('admin.kelolaproduk');
    }

    public function produknonaktif()
    {
        $produk = Produk::where('status_produk', 'Non-Aktif')->paginate(10);
        return view('admin.kelolaproduknonaktif', ['produk' => $produk])->with('success', 'Data Produk Berhasil Di Non-aktifkan');
    }

    public function ubahstatusprodukaktf($id)
    {
        $produk = Produk::find($id);
        $produk->update(['status_produk' => 'Aktif']);

        return redirect()->route('admin.kelolaproduk')->with('success', 'Data Produk Berhasil Di Aktifkan');;
    }

    public function getUkuran(Request $request)
    {
        $ukuran = [];
        if ($search = $request->name) {
            $ukuran = UkuranModel::where('ukuran', 'LIKE', "%$search%")->get();
        }
        return response()->json($ukuran);
    }

    public function cariDetailPenjualanProduk(Request $request) {
        $data = $request->cari;
        $produk = Produk::where('nama_produk', 'like', '%' . $data . '%')->where('status_produk', 'Aktif')->paginate(10);
        // dd($produk);
        return view('admin.detailpenjualanproduk', [
            'produk' => $produk,
        ]);
    }

    public function detailpenjualanproduk()
    {
        $now = Carbon::now()->format('Y');

        // dd($jumlah);
        // $produk = DB::table('pesanandetails')
        // ->join('produk', 'produk.id_produk', '=', 'pesanandetails.produk_id')
        // ->select(DB::raw())
        // ->get();
        $produk = DB::table('produk')
            ->leftJoin('pesanandetails', function ($join) {
                $join->on('produk.id_produk', '=', 'pesanandetails.produk_id')
                    ->where('pesanandetails.updated_at', '>=', Carbon::now()->subYear());
            })
            ->leftJoin('pesanans', function ($join) {
                $join->on('pesanandetails.pesanan_id', '=', 'pesanans.id')
                    ->where('pesanans.status', '=', 'Selesai');
            })
            ->select('produk.nama_produk','produk.harga', 'produk.jumlah_produk', 'produk.deskripsi', 'produk.kategori_produk', 'produk.ukuran_produk','produk.warna', 'produk.angkatan', 'produk.id_produk','produk.gambar_produk','produk.role_pembeli')
            ->selectRaw('SUM(CASE WHEN YEAR(pesanans.tanggal) = '.$now.' THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS total')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 1 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS januari')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 2 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS februari')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 3 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS maret')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 4 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS april')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 5 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS mei')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 6 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS juni')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 7 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS juli')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 8 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS agustus')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 9 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS september')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 10 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS oktober')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 11 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS november')
            ->selectRaw('SUM(CASE WHEN MONTH(pesanans.tanggal) = 12 THEN COALESCE(pesanandetails.jumlah, 0) ELSE 0 END) AS desember')
            ->groupBy('id_produk','produk.nama_produk', 'produk.harga', 'produk.jumlah_produk', 'produk.deskripsi', 'produk.kategori_produk', 'produk.ukuran_produk','produk.warna', 'produk.angkatan','produk.gambar_produk','produk.role_pembeli')
            ->orderBy('total', 'DESC')
            ->paginate(10);
        return view('admin.detailpenjualanproduk', [
            'produk' => $produk,
        ]);
    }
}
