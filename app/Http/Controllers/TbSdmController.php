<?php

namespace App\Http\Controllers;

use App\Models\Tb_sdm;
use App\Models\Tb_wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbSdmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sdm = Tb_sdm::all();
        $wilayah = Tb_wilayah::all();
        return view('admin.sdm.index', compact('sdm', 'wilayah'));
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
            'id_wilayah' => 'required|unique:tb_sdms', 
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
        $sdm = new Tb_sdm();
        $sdm->id_wilayah = $request->id_wilayah;
        $sdm->total = $request->total;
        $sdm->pns = $request->pns;
        $sdm->non_pns = $request->non_pns;
        $sdm->jafung_damkaar = $request->jafung_damkaar;
        $sdm->jafung_analis = $request->jafung_analis;
        $sdm->diklat_apbd = $request->diklat_apbd;
        $sdm->diklat_apbn = $request->diklat_apbn;
        $sdm->jenis = $request->jenis;
        $sdm->save();
        session()->put('success', 'Data Berhasil Di Tambahkan');
        return redirect()->route('sdm.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_sdm  $tb_sdm
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_sdm $tb_sdm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_sdm  $tb_sdm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sdm = Tb_sdm::findOrFail($id);
        return view('admin.sdm.edit', compact('sdm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_sdm  $tb_sdm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'id_wilayah' => 'required', 
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

        $sdm = Tb_sdm::find($id);
        $sdm->id_wilayah = $request->id_wilayah;
        $sdm->total = $request->total;
        $sdm->pns = $request->pns;
        $sdm->non_pns = $request->non_pns;
        $sdm->jafung_damkaar = $request->jafung_damkaar;
        $sdm->jafung_analis = $request->jafung_analis;
        $sdm->diklat_apbd = $request->diklat_apbd;
        $sdm->diklat_apbn = $request->diklat_apbn;
        $sdm->jenis = $request->jenis;
        $sdm->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->route('sdm.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_sdm  $tb_sdm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sdm = Tb_sdm::findOrFail($id);
        if (!Tb_sdm::destroy($id)) {
            return redirect()->back();
        } else {
            $sdm->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('sdm.index');
        }
    }
}