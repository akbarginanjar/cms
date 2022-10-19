<?php

namespace App\Http\Controllers;

use App\Models\Tb_spm;
use App\Models\Tb_tahun_spm;
use Illuminate\Http\Request;

class TbTahunSpmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tb_spm $tb_spm)
    {
        $spmm = Tb_spm::find($tb_spm->id);
        $spm = Tb_tahun_spm::where('id_spm', $tb_spm->id)->get();
        return view('admin.spm.spm', compact("spm", "spmm"));
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
     * @param  \App\Models\Tb_tahun_spm  $tb_tahun_spm
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_tahun_spm $tb_tahun_spm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_tahun_spm  $tb_tahun_spm
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_tahun_spm $tb_tahun_spm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_tahun_spm  $tb_tahun_spm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_spm $tb_spm, $id)
    {
        $spm = Tb_tahun_spm::find($id);
        $spm->nilai_spm = $request->nilai_spm;
        $spm->save();
        return redirect('/admin/spm/' . $tb_spm->id . '/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_tahun_spm  $tb_tahun_spm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_tahun_spm $tb_tahun_spm)
    {
        //
    }
}
