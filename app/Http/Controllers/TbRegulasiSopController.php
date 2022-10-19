<?php

namespace App\Http\Controllers;

use App\Models\Tb_regulasi_sop;
use Illuminate\Http\Request;

class TbRegulasiSopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regulasiSop = Tb_regulasi_sop::all();
        return view('admin.regulasi-sop.index', compact('regulasiSop'));
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
    public function edit(Tb_regulasi_sop $tb_regulasi_sop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_regulasi_sop  $tb_regulasi_sop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_regulasi_sop $tb_regulasi_sop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_regulasi_sop  $tb_regulasi_sop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_regulasi_sop $tb_regulasi_sop)
    {
        //
    }
}
