<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function user(){
        $pengguna = User::all();
        return view('admin.kelolapengguna',compact('pengguna'));
    }

    public function viewtambahuser(){
        return view('admin.tambahpengguna');
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

        return redirect()->route("admin.kelolapengguna");
    }

    public function hapuspengguna($id){
        $pengguna = User::find($id);
        $pengguna->delete();

        return redirect()->route('admin.kelolapengguna');
    }

    public function viewubahuser($id){
        $pengguna = User::findOrFail($id);
        return view('admin.ubahpengguna',compact('pengguna'));
    }

    public function ubahpengguna(Request $request, $id){
        $produk = User::find($id);
        $produk->update($request->all());

        return redirect()->route('admin.kelolapengguna');
    }
}
