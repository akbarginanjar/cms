<?php

namespace App\Http\Controllers;

use App\Models\Tb_anggaran;
use App\Models\Tb_wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggaran = Tb_anggaran::all();
        $wilayah = Tb_wilayah::all();
        return view('admin.anggaran.index', compact('anggaran', 'wilayah'));
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
            'id_wilayah' => 'required', 
            'tahun' => 'required',
            'anggaran' => 'required',
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
        $anggaran = new Tb_anggaran();
        $anggaran->id_wilayah = $request->id_wilayah;
        $anggaran->tahun = $request->tahun;
        $anggaran->anggaran = $request->anggaran;
        $anggaran->save();
        session()->put('success', 'Data Berhasil Di Tambahkan');
        return redirect()->route('anggaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_anggaran  $tb_anggaran
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_anggaran $tb_anggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_anggaran  $tb_anggaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_anggaran $tb_anggaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_anggaran  $tb_anggaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'id_wilayah' => 'required', 
            'tahun' => 'required',
            'anggaran' => 'required',
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

        $anggaran = Tb_anggaran::find($id);
        $anggaran->id_wilayah = $request->id_wilayah;
        $anggaran->tahun = $request->tahun;
        $anggaran->anggaran = $request->anggaran;
        $anggaran->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->route('anggaran.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_anggaran  $tb_anggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggaran = Tb_anggaran::findOrFail($id);
        if (!Tb_anggaran::destroy($id)) {
            return redirect()->back();
        } else {
            $anggaran->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('anggaran.index');
        }
    }
}
