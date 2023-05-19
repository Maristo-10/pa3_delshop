<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // function to import data excel
    public function import(Request $request) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move('UsersData', $fileName);
        Excel::import(new UsersImport, \public_path('/UsersData/'.$fileName));

        return redirect()->route("admin.kelolapengguna")->with('success', 'Data imported successfully!');
    }

    public function user(){
        $pengguna = User::paginate(5);
        return view('admin.kelolapengguna',compact('pengguna'));
    }

    public function viewtambahuser(){
        return view('admin.tambahpengguna');
    }

    public function viewimport() {
        return view('admin.tambahpenggunaimport');
    }

    public function tambahuser(Request $request){
        $arrName = [];
        $id = $request->id;

        $validatedData = $request->validate([
            'gambar_pengguna'=>'image|file|max:10000'
        ]);

        $pass = '$2y$10$5DNeMBwr01c/PxQDS7I6BOcxxQL5GT7naGt4Bftj5LBGZ4hgb8JO6'; //delshop123
        $tambahuser = new User();
        $tambahuser->name = $request->name;
        $tambahuser->email = $request->email;
        $tambahuser->password = $pass;
        $tambahuser->role_pengguna = $request->role_pengguna;
        if($request->file('gambar_pengguna')){

            if ($request->hasfile('gambar_pengguna')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('gambar_pengguna')->getClientOriginalName());
                $request->file('gambar_pengguna')->move(public_path('user-images'), $filename);
                $tambahuser->gambar_pengguna = $filename;
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        if (!$tambahuser->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }

        return redirect()->route("admin.kelolapengguna")->with('success','Data Produk Berhasil di tambah');;
    }

    public function hapuspengguna($id){
        $pengguna = User::find($id);
        $pengguna->delete();

        return redirect()->route('admin.kelolapengguna')->with('success','Data Produk Berhasil di hapus');;
    }

    public function viewubahuser($id){
        $pengguna = User::findOrFail($id);
        return view('admin.ubahpengguna',compact('pengguna'));
    }

    public function ubahpengguna(Request $request, $id){
        $produk = User::find($id);
        $produk->update($request->all());

        return redirect()->route('admin.kelolapengguna')->with('success','Data Produk Berhasil di Ubah');;
    }

    public function vprofile(){
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status','keranjang')->first();
        if(empty($pesanan_baru)){
            $pesanan = 0;
        }else{
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id',$pesanan_baru->id)->get();
        }

        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $pengguna = User::where('id', Auth::user()->id)->get();
        return view('pembeli.profile',[
            'pesanan'=>$pesanan,
            'pengguna'=>$pengguna,
            'pesanan_baru'=>$pesanan_baru,
            'pengguna_prof'=>$pengguna_prof
        ]);
    }

    public function uprofile(Request $request){
        $pengguna = User::where('id', Auth::user()->id);

        $name = $request->name;
        $jenis_kelamin = $request->jenis_kelamin;
        $pekerjaan = $request->pekerjaan;
        $alamat = $request->alamat;
        $no_telp = $request->no_telp;
        $tentang = $request->tentang;
        $email = $request->email;
        $twitter = $request->twitter;
        $facebook = $request->facebook;
        $instagram = $request->instagram;
        $linkedin = $request->linkedin;
        if($request->file('gambar_pengguna')){
            if ($request->hasfile('gambar_pengguna')) {
                $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('gambar_pengguna')->getClientOriginalName());
                $request->file('gambar_pengguna')->move(public_path('profile-images'), $filename);
                $pengguna->update(['gambar_pengguna'=>$filename]);
            }else{
                $profile = 'baju.png';
                $pengguna->update(['gambar_pengguna'=>$profile]);
            }

            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        $pengguna->update([
            'name'=>$name,
            'jenis_kelamin'=>$jenis_kelamin,
            'pekerjaan'=>$pekerjaan,
            'alamat'=>$alamat,
            'no_telp'=>$no_telp,
            'tentang'=>$tentang,
            'email'=>$email,
            'twitter'=>$twitter,
            'facebook'=>$facebook,
            'instagram'=>$instagram,
            'linkedin'=>$linkedin,
        ]);

        return redirect()->route('pembeli.profile');
    }

}
