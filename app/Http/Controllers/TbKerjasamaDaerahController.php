<?php

namespace App\Http\Controllers;

use App\Models\Tb_kerjasama_daerah;
use Illuminate\Http\Request;

class TbKerjasamaDaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kerjasamaDaerah = Tb_kerjasama_daerah::all();
        return view('admin.kerjasama-daerah.index', compact('kerjasamaDaerah'));
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
     * @param  \App\Models\Tb_kerjasama_daerah  $tb_kerjasama_daerah
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kerjasama_daerah $tb_kerjasama_daerah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kerjasama_daerah  $tb_kerjasama_daerah
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_kerjasama_daerah $tb_kerjasama_daerah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kerjasama_daerah  $tb_kerjasama_daerah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_kerjasama_daerah $tb_kerjasama_daerah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kerjasama_daerah  $tb_kerjasama_daerah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_kerjasama_daerah $tb_kerjasama_daerah)
    {
        //
    }
}
