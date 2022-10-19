<?php

namespace App\Http\Controllers;

use App\Models\Tb_spm;
use App\Models\Tb_wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbSpmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spm = Tb_spm::all();
        $wilayah = Tb_wilayah::all();
        return view('admin.spm.index', compact('spm', 'wilayah'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'nilai_spm' => 'required',
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
        $spm = new Tb_spm();
        $spm->id_wilayah = $request->id_wilayah;
        $spm->tahun = $request->tahun;
        $spm->nilai_spm = $request->nilai_spm;
        $spm->save();
        session()->put('success', 'Data Berhasil Di Tambahkan');
        return redirect()->route('spm.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_spm  $tb_spm
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_spm $tb_spm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_spm  $tb_spm
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_spm $tb_spm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_spm  $tb_spm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'id_wilayah' => 'required', 
            'tahun' => 'required',
            'nilai_spm' => 'required',
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

        $spm = Tb_spm::find($id);
        $spm->id_wilayah = $request->id_wilayah;
        $spm->tahun = $request->tahun;
        $spm->nilai_spm = $request->nilai_spm;
        $spm->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->route('spm.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_spm  $tb_spm
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spm = Tb_spm::findOrFail($id);
        if (!Tb_spm::destroy($id)) {
            return redirect()->back();
        } else {
            $spm->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('spm.index');
        }
    }
}
