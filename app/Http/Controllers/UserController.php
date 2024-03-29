<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailPesanan;
use App\Models\GantiRoles;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // function to import data excel
    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move('UsersData', $fileName);
        Excel::import(new UsersImport, \public_path('/UsersData/' . $fileName));
        if (Session::has('error')) {
            return redirect()->route("admin.kelolapengguna")->with('error', Session::get('error'));
        }
        return redirect()->route("admin.kelolapengguna")->with('success', 'Data berhasil diimport!');
    }

    public function user()
    {
        $pengguna = User::where('id', "!=", 1)->paginate(10);

        return view('admin.kelolapengguna', compact('pengguna'));
    }

    // function to delete multiple rows
    public function deleteMultipleRows(Request $request) {
        $selectedItems = $request->input('selectedItems');
        // dd($selectedItems);
        if($selectedItems) {
            User::whereIn('id', $selectedItems)->delete();
        }

        return redirect()->route("admin.kelolapengguna")->with('success', 'Data berhasil dihapus');
    }

    public function viewtambahuser()
    {
        return view('admin.tambahpengguna');
    }

    public function viewimport()
    {
        return view('admin.tambahpenggunaimport');
    }

    public function tambahuser(Request $request)
    {
        $arrName = [];
        $id = $request->id;

        $validatedData = $request->validate([
            'gambar_pengguna' => 'image|file|max:10000'
        ]);

        $pass = '$2y$10$5DNeMBwr01c/PxQDS7I6BOcxxQL5GT7naGt4Bftj5LBGZ4hgb8JO6'; //delshop123
        $tambahuser = new User();
        $tambahuser->name = $request->name;
        $tambahuser->email = $request->email;
        $tambahuser->password = $pass;
        $tambahuser->role_pengguna = $request->role_pengguna;
        if ($request->file('gambar_pengguna')) {

            if ($request->hasfile('gambar_pengguna')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('gambar_pengguna')->getClientOriginalName());
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

        return redirect()->route("admin.kelolapengguna")->with('success', 'Data Produk Berhasil di tambah');
    }

    public function hapuspengguna($id)
    {
        $pengguna = User::find($id);
        $pengguna->delete();

        return redirect()->route('admin.kelolapengguna')->with('success', 'Data Produk Berhasil di hapus');
    }

    public function hapusallpengguna(Request $request)
    {
        $ids = $request->input('ids');
        User::whereIn('id', $ids)->delete();
		// User::whereIn('id',explode(",",$ids))->delete();
		return redirect()->back()->with('success', 'Selected users have been deleted.');
    }

    public function viewubahuser($id)
    {
        $pengguna = User::findOrFail($id);
        return view('admin.ubahpengguna', compact('pengguna'));
    }

    public function ubahpengguna(Request $request, $id)
    {
        $produk = User::find($id);
        $produk->update($request->all());

        return redirect()->route('admin.kelolapengguna')->with('success', 'Data Produk Berhasil di Ubah');;
    }

    public function vprofile()
    {
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 'keranjang')->first();
        if (empty($pesanan_baru)) {
            $pesanan = 0;
        } else {
            $pesanan = DetailPesanan::select(DB::raw('count(id) as total'))->groupBy("pesanan_id")->where('pesanan_id', $pesanan_baru->id)->get();
        }

        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $pengguna = User::where('id', Auth::user()->id)->get();
        $header = User::where('role_pengguna', "Admin")->first();
        return view('pembeli.profile', [
            'pesanan' => $pesanan,
            'pengguna' => $pengguna,
            'pesanan_baru' => $pesanan_baru,
            'pengguna_prof' => $pengguna_prof,
            'header'=>$header
        ]);
    }

    public function uprofile(Request $request)
    {
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
        if ($request->file('gambar_pengguna')) {
            if ($request->hasfile('gambar_pengguna')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('gambar_pengguna')->getClientOriginalName());
                $request->file('gambar_pengguna')->move(public_path('profile-images'), $filename);
                $pengguna->update(['gambar_pengguna' => $filename]);
            } else {
                $profile = 'baju.png';
                $pengguna->update(['gambar_pengguna' => $profile]);
            }

            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        $pengguna->update([
            'name' => $name,
            'jenis_kelamin' => $jenis_kelamin,
            'pekerjaan' => $pekerjaan,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'tentang' => $tentang,
            'email' => $email,
            'twitter' => $twitter,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'linkedin' => $linkedin,
        ]);

        if (route('admin.profile')) {
            return redirect()->route('admin.profile');
        }

        if (route('pembeli.profile')) {
            return redirect()->route('pembeli.profile');
        }
    }

    public function aprofile()
    {
        $pengguna_prof = User::where('id', Auth::user()->id)->get();
        $pengguna = User::where('id', Auth::user()->id)->get();
        return view('admin.profile', [
            'pengguna' => $pengguna,
            'pengguna_prof' => $pengguna_prof
        ]);
    }

    public function upprofile(Request $request)
    {
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
        if ($request->file('gambar_pengguna')) {
            if ($request->hasfile('gambar_pengguna')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('gambar_pengguna')->getClientOriginalName());
                $request->file('gambar_pengguna')->move(public_path('profile-images'), $filename);
                $pengguna->update(['gambar_pengguna' => $filename]);
            } else {
                $profile = 'baju.png';
                $pengguna->update(['gambar_pengguna' => $profile]);
            }

            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        $pengguna->update([
            'name' => $name,
            'jenis_kelamin' => $jenis_kelamin,
            'pekerjaan' => $pekerjaan,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'tentang' => $tentang,
            'email' => $email,
            'twitter' => $twitter,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'linkedin' => $linkedin,
        ]);

        return redirect()->route('admin.profile');
    }

    public function gantiRoles(Request $request)
    {
        $arrName = [];

        $gantiRoles = new GantiRoles();
        $gantiRoles->user_id = Auth::user()->id;
        $gantiRoles->name = Auth::user()->name;
        $gantiRoles->email = Auth::user()->email;
        $gantiRoles->user_role = $request->role;
        if ($request->file('bukti')) {

            if ($request->hasfile('bukti')) {
                $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('bukti')->getClientOriginalName());
                $request->file('bukti')->move(public_path('ganti-roles-images'), $filename);
                $gantiRoles->bukti = $filename;
            }
            // $validatedData['gambar_produk'] = $request->file('gambar_produk')->store('product-images');
            // $tambahproduk->gambar_produk = $request->gambar_produk;
        }
        if (!$gantiRoles->save()) {
            if (count($arrName) > 1) {
                foreach ($arrName as $path) {
                    unlink(public_path() . $path);
                }
            }
        }

        return redirect()->route("pembeli.profile")->with('success', 'Ganti Profile Berhasil Direquest');
    }

    public function kelolaReq()
    {
        $gantiRole = GantiRoles::where('status', "Menunggu")->paginate(10);
        $jumlah = $gantiRole->count();

        return view('admin.kelolagantirole', [
            'gantiRole' => $gantiRole,
            'jumlah' =>$jumlah
        ]);
    }

    public function setuju($id, Request $request)
    {
        $gantiRole = GantiRoles::find($id);

        $gantiRole->update([
            'status' => $request->status,
        ]);

        $user = User::where('id', $gantiRole->user_id)->first();

        $user->update([
            'role_pengguna' => $gantiRole->user_role,
        ]);

        return redirect()->route("admin.kelolagantirole")->with('success', 'Ganti Role Disetujui');
    }

    public function tidakSetuju($id)
    {
        $gantiRole = GantiRoles::find($id);
        $user = User::where('id', $gantiRole->user_id)->first();

        $gantiRole->update([
            'status' => "Ditolak"
        ]);

        return redirect()->route("admin.kelolagantirole")->with('success', 'Ganti Role Ditolak');
    }
}
