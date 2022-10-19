<?php

namespace App\Http\Controllers;

use App\Models\Tb_kategori_artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TbKategoriArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriArtikel = Tb_kategori_artikel::all();
        return view('admin.kategori-artikel.index', compact('kategoriArtikel'));
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
            'nama' => 'required|unique:tb_kategori_artikels',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
            'unique' => 'Data sudah ada!'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $kategoriArtikel = new Tb_kategori_artikel();
        $kategoriArtikel->nama = $request->nama;
        $kategoriArtikel->slug = Str::slug($request->nama);
        $kategoriArtikel->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect()->route('kategori-artikel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_kategori_artikel  $tb_kategori_artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kategori_artikel $tb_kategori_artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kategori_artikel  $tb_kategori_artikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_kategori_artikel $tb_kategori_artikel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kategori_artikel  $tb_kategori_artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!'
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $kategoriArtikel = Tb_kategori_artikel::findOrFail($id);
        $kategoriArtikel->nama = $request->nama;
        $kategoriArtikel->slug = Str::slug($request->nama);
        $kategoriArtikel->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect()->route('kategori-artikel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kategori_artikel  $tb_kategori_artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategoriArtikel = Tb_kategori_artikel::findOrFail($id);
        if (!Tb_kategori_artikel::destroy($id)) {
            return redirect()->back();
        } else {
            $kategoriArtikel->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('kategori-artikel.index');
        }
    }
}
