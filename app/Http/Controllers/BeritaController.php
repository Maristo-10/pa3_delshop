<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
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
        $beritas = Berita::orderBy('id','desc')->Paginate(5);
        return view('admin.kelolaberita',compact('beritas'))
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

        $foto->move(public_path('img/'), $path);

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
            $foto->move(public_path('img/'), $path);
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
        $berita->delete();

        return redirect()->route('beritas.index')->with('success', 'Data berhasil di hapus'); 
    }
}
