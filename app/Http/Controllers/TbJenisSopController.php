<?php

namespace App\Http\Controllers;

use App\Models\Tb_jenis_sop;
use App\Models\Tb_regulasi_sop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbJenisSopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tb_regulasi_sop $tb_regulasi_sop)
    {
        $regulasiSop = Tb_regulasi_sop::find($tb_regulasi_sop->id);
        $sop = Tb_jenis_sop::where('id_regulasi', $tb_regulasi_sop->id)->get();
        return view('admin.regulasi-sop.jenis-sop', compact('regulasiSop', 'sop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tb_regulasi_sop $tb_regulasi_sop)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tb_regulasi_sop $tb_regulasi_sop)
    {
        $rules = [
            'nama' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $jenis_sop = new Tb_jenis_sop();
        $jenis_sop->id_regulasi = $tb_regulasi_sop->id;
        $jenis_sop->nama = $request->nama;
        $jenis_sop->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/regulasi-sop/' . $tb_regulasi_sop->id . '/jenis-sop');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_regulasi_sop  $tb_regulasi_sop
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_regulasi_sop $tb_regulasi_sop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_regulasi_sop  $tb_regulasi_sop
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_regulasi_sop $tb_regulasi_sop, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_regulasi_sop  $tb_regulasi_sop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_regulasi_sop $tb_regulasi_sop, $id)
    {
        $rules = [
            'nama' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $jenis_sop = Tb_jenis_sop::find($id);
        $jenis_sop->id_regulasi = $tb_regulasi_sop->id;
        $jenis_sop->nama = $request->nama;
        $jenis_sop->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect('/admin/regulasi-sop/' . $tb_regulasi_sop->id . '/jenis-sop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_regulasi_sop  $tb_regulasi_sop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_regulasi_sop $tb_regulasi_sop, $id)
    {
        $jenis_sop = Tb_jenis_sop::findOrFail($id);
        $jenis_sop->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect('/admin/regulasi-sop/' . $tb_regulasi_sop->id . '/jenis-sop');
    }
}
