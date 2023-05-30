<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function berita()
    {
        $beritas = Berita::orderBy('status','asc')->orderBy('updated_at','desc')->Paginate(5);
        if($beritas == null){
            $jumlah = Carbon::now();
            $jumlah->total = 0;
        }else{
            $jumlah = Berita::select(DB::raw('CAST(count(id) as UNSIGNED INTEGER ) as total'))->where('status', 'Aktif')->groupBy('status')->first();
        }
        return view('admin.kelolaberita',([
            'beritas'=>$beritas,
            'jumlah'=>$jumlah
        ]))
            ->with('i',(request()->input('page',1) - 1) * 5);
        // $data['beritas'] = Berita::orderBy('id', 'desc')->simplePaginate(5);

        // return view('admin.kelolaberita', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambahberita');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'description' => 'required',
        ]);

        $foto = $request->file('image');

        $path = $foto->store('product', 'public');

        $foto->move(public_path('berita-images/'), $path);

        $berita = new Berita();
        $berita->title = $request->title;
        $berita->subtitle = $request->subtitle;
        $berita->image = basename($path);
        $berita->description = $request->description;
        $berita->save();

        return redirect()->route('admin.kelolaberita')
                    ->with('success', 'Data berhasil dibuat');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('beritas.show',compact('berita'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita::find($id);
        return view('admin.ubahberita',compact('berita'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);
        $berita -> title = $request->title;
        $berita -> subtitle = $request->subtitle;
        $berita -> description = $request->description;
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            ]);

            $foto = $request->file('image');
            $path = $foto->store('berita', 'public');
            $foto->move(public_path('berita-images/'), $path);
            $berita -> image = basename($path);
        }
        $berita -> save();

        return redirect()->route('admin.kelolaberita')->with('success', 'Data sudah berhasil di ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita =Berita::find($id);
        $non = 'Non-Aktif';
        $berita->status = $non;

        $berita->save();

        return redirect()->route('admin.kelolaberita')->with('success', 'Data berhasil di non-aktifkan!');
    }

    public function aktifkan($id)
    {
        $berita =Berita::find($id);
        $non = 'Aktif';
        $berita->status = $non;

        $berita->save();

        return redirect()->route('admin.kelolaberita')->with('success', 'Data berhasil di aktifkan!');
    }
}

