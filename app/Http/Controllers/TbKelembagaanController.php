<?php

namespace App\Http\Controllers;

use App\Models\Tb_kelembagaan;
use App\Models\Tb_wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbKelembagaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelembagaan = Tb_kelembagaan::all();
        $wilayah = Tb_wilayah::all();
        return view('admin.kelembagaan.index', compact('kelembagaan', 'wilayah'));
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
            'id_wilayah' => 'required|unique:tb_kelembagaans', 
            'dinas_mandiri' => 'required',
            'satpol_pp' => 'required',
            'bpbd' => 'required',
            'tipologi_kelembagaan' => 'required',
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
        $kelembagaan = new Tb_kelembagaan();
        $kelembagaan->id_wilayah = $request->id_wilayah;
        $kelembagaan->dinas_mandiri = $request->dinas_mandiri;
        $kelembagaan->satpol_pp = $request->satpol_pp;
        $kelembagaan->bpbd = $request->bpbd;
        $kelembagaan->tipologi_kelembagaan = $request->tipologi_kelembagaan;
        $kelembagaan->save();
        session()->put('success', 'Data Berhasil Di Tambahkan');
        return redirect()->route('kelembagaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_kelembagaan  $tb_kelembagaan
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kelembagaan $tb_kelembagaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kelembagaan  $tb_kelembagaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_kelembagaan $tb_kelembagaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kelembagaan  $tb_kelembagaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'id_wilayah' => 'required', 
            'dinas_mandiri' => 'required',
            'satpol_pp' => 'required',
            'bpbd' => 'required',
            'tipologi_kelembagaan' => 'required',
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

        $kelembagaan = Tb_kelembagaan::find($id);
        $kelembagaan->id_wilayah = $request->id_wilayah;
        $kelembagaan->dinas_mandiri = $request->dinas_mandiri;
        $kelembagaan->satpol_pp = $request->satpol_pp;
        $kelembagaan->bpbd = $request->bpbd;
        $kelembagaan->tipologi_kelembagaan = $request->tipologi_kelembagaan;
        $kelembagaan->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->route('kelembagaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kelembagaan  $tb_kelembagaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelembagaan = Tb_kelembagaan::findOrFail($id);
        if (!Tb_kelembagaan::destroy($id)) {
            return redirect()->back();
        } else {
            $kelembagaan->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('kelembagaan.index');
        }
    }
}
