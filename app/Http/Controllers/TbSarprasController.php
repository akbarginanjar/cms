<?php

namespace App\Http\Controllers;

use App\Models\Tb_sarpras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbSarprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sarpras = Tb_sarpras::all();
        return view('admin.sarpras.index', compact('sarpras'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_sarpras  $tb_sarpras
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_sarpras $tb_sarpras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_sarpras  $tb_sarpras
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_sarpras  $tb_sarpras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'jml_kecamatan' => 'required',
            'jml_pos' => 'required',
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

        $sarpras = Tb_sarpras::find($id);
        $sarpras->jml_kecamatan = $request->jml_kecamatan;
        $sarpras->jml_pos = $request->jml_pos;
        $sarpras->save();
        session()->put('success', 'Data Berhasil Di Edit');
        return redirect()->route('sarpras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_sarpras  $tb_sarpras
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sarpras = Tb_sarpras::findOrFail($id);
        if (!Tb_sarpras::destroy($id)) {
            return redirect()->back();
        } else {
            $sarpras->delete();
            session()->put('success', 'Data Berhasil Di Hapus');
            return redirect()->route('sarpras.index');
        }
    }
}
