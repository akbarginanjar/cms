<?php

namespace App\Http\Controllers;

use App\Models\Tb_artikel;
use App\Models\Tb_kategori_artikel;
use App\Models\Tb_konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TbArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Tb_artikel::all();
        $kategoriArtikel = Tb_kategori_artikel::all();
        return view('admin.artikel.index', compact('artikel', 'kategoriArtikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required|unique:tb_artikels',
            'id_kategori_artikel' => 'required',
            'teks' => 'required|min:50',
            'gambar' => 'image|max:2048',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
            'unique' => 'Data sudah ada!',
            'min' => 'Teks minimal :min karakter'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $artikel = new Tb_artikel();
        $artikel->id_kategori_artikel = $request->id_kategori_artikel;
        $artikel->judul = $request->judul;
        $artikel->slug = Str::slug($request->judul);
        $artikel->teks = $request->teks;
        if ($request->hasFile('gambar')) {
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/artikel/', $name);
            $artikel->gambar = $name;
        }
        $artikel->save();

        $konten = new Tb_konten();
        $konten->id_artikel = $artikel->id;
        $konten->type = "artikel";
        $konten->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('artikel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_artikel  $tb_artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_artikel $tb_artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_artikel  $tb_artikel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = Tb_artikel::findOrFail($id);
        $kategoriArtikel = Tb_kategori_artikel::all();
        return view('admin.artikel.edit', compact('artikel', 'kategoriArtikel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_artikel  $tb_artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'judul' => 'required',
            'id_kategori_artikel' => 'required',
            'teks' => 'required|min:50',
            'gambar' => 'image|max:2048',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
            'min' => 'Teks minimal :min karakter'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $artikel = Tb_artikel::findOrFail($id);
        $artikel->id_kategori_artikel = $request->id_kategori_artikel;
        $artikel->judul = $request->judul;
        $artikel->slug = Str::slug($request->judul);
        $artikel->teks = $request->teks;
        if ($request->hasFile('gambar')) {
            $artikel->deleteGambar();
            $image = $request->gambar;
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/artikel/', $name);
            $artikel->gambar = $name;
        }
        $artikel->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('artikel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_artikel  $tb_artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel = Tb_artikel::findOrFail($id);
        $artikel->deleteGambar();
        $artikel->delete();

        $kontens = Tb_konten::where('id_artikel', $artikel->id)->get();
        foreach ($kontens as $kontenb) {
            $kontenb;
        }
        $konten = Tb_konten::find($kontenb->id);
        $konten->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect()->route('artikel.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images/artikel'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/artikel/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
