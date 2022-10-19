<?php

namespace App\Http\Controllers;

use App\Models\Tb_relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbRelawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relawan = Tb_relawan::all();
        return view('admin.relawan.index', compact('relawan'));
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
            'id_wilayah' => 'required|unique:tb_relawans',
            'total' => 'required',
            'pns' => 'required',
            'non_pns' => 'required',
            'jafung_damkaar' => 'required',
            'jafung_analis' => 'required',
            'diklat_apbd' => 'required',
            'diklat_apbn' => 'required',
            'jenis' => 'required',
        ];

        $message = [
            'required' => 'Data tidak boleh kosong',
            'unique' => 'Wilayah Sudah Terpakai!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $relawan = new Tb_relawan();
        $relawan->id_wilayah = $request->id_wilayah;
        $relawan->total = $request->total;
        $relawan->pns = $request->pns;
        $relawan->non_pns = $request->non_pns;
        $relawan->jafung_damkaar = $request->jafung_damkaar;
        $relawan->jafung_analis = $request->jafung_analis;
        $relawan->diklat_apbd = $request->diklat_apbd;
        $relawan->diklat_apbn = $request->diklat_apbn;
        $relawan->jenis = $request->jenis;
        $relawan->save();
        session()->put('success', 'Data Berhasil Di Tambahkan');
        return redirect()->route('relawan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_relawan  $tb_relawan
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_relawan $tb_relawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_relawan  $tb_relawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relawan = Tb_relawan::findOrFail($id);
        return view('admin.relawan.edit', compact('relawan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_relawan  $tb_relawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'jml_kecamatan' => 'required',
            'jml_desa' => 'required',
            'redkar' => 'required',
            'organisasi' => 'required',
        ];

        $message = [
            'required' => 'Data tidak boleh kosong',
            'unique' => 'Wilayah Sudah Terpakai!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }

        $relawan = Tb_relawan::find($id);
        $relawan->jml_kecamatan = $request->jml_kecamatan;
        $relawan->jml_desa = $request->jml_desa;
        $relawan->redkar = $request->redkar;
        $relawan->organisasi = $request->organisasi;
        $relawan->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->route('relawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_relawan  $tb_relawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relawan = Tb_relawan::findOrFail($id);
        if (!Tb_relawan::destroy($id)) {
            return redirect()->back();
        } else {
            $relawan->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('relawan.index');
        }
    }
}
