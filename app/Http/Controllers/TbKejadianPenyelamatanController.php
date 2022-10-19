<?php

namespace App\Http\Controllers;

use App\Models\Tb_kejadian_penyelamatan;
use Illuminate\Http\Request;

class TbKejadianPenyelamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kejadianPenyelamatan = Tb_kejadian_penyelamatan::all();
        return view('admin.kejadian-penyelamatan.index', compact('kejadianPenyelamatan'));
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
     * @param  \App\Models\Tb_kejadian_penyelamatan  $tb_kejadian_penyelamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kejadian_penyelamatan  $tb_kejadian_penyelamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kejadian_penyelamatan  $tb_kejadian_penyelamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kejadian_penyelamatan  $tb_kejadian_penyelamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan)
    {
        //
    }
}
