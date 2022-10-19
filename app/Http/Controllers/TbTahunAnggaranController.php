<?php

namespace App\Http\Controllers;

use App\Models\Tb_anggaran;
use App\Models\Tb_tahun_anggaran;
use Illuminate\Http\Request;

class TbTahunAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tb_anggaran $tb_anggaran)
    {
        $anggarans = Tb_anggaran::find($tb_anggaran->id);
        $anggaran = Tb_tahun_anggaran::where('id_anggaran', $tb_anggaran->id)->get();
        return view('admin.anggaran.anggaran', compact("anggaran", "anggarans"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_tahun_anggaran  $tb_tahun_anggaran
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_tahun_anggaran $tb_tahun_anggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_tahun_anggaran  $tb_tahun_anggaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_tahun_anggaran $tb_tahun_anggaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_tahun_anggaran  $tb_tahun_anggaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_anggaran $tb_anggaran, $id)
    {
        $anggaran = Tb_tahun_anggaran::find($id);
        $anggaran->anggaran = $request->anggaran;
        $anggaran->save();
        return redirect('/admin/anggaran/' . $tb_anggaran->id . '/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_tahun_anggaran  $tb_tahun_anggaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_tahun_anggaran $tb_tahun_anggaran)
    {
        //
    }
}
