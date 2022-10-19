<?php

namespace App\Http\Controllers;

use App\Models\Tb_anggaran;
use App\Models\Tb_spm;
use App\Models\Tb_tahun;
use App\Models\Tb_tahun_anggaran;
use App\Models\Tb_tahun_spm;
use Illuminate\Http\Request;

class TbTahunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $tahun = new Tb_tahun();
        $tahun->tahun = $request->tahun;
        $tahun->save();

        $spm = Tb_spm::all();
        foreach ($spm as $item) {
            $tahunSpm = new Tb_tahun_spm();
            $tahunSpm->id_spm = $item->id;
            $tahunSpm->tahun = $request->tahun;
            $tahunSpm->nilai_spm = 0;
            $tahunSpm->save();
        }
        $anggaran = Tb_anggaran::all();
        foreach ($anggaran as $item) {
            $tahunAnggaran = new Tb_tahun_anggaran();
            $tahunAnggaran->id_anggaran = $item->id;
            $tahunAnggaran->tahun = $request->tahun;
            $tahunAnggaran->anggaran = 0;
            $tahunAnggaran->save();
        }
        return redirect('/admin/spm');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_tahun  $tb_tahun
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_tahun $tb_tahun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_tahun  $tb_tahun
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_tahun $tb_tahun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_tahun  $tb_tahun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_tahun $tb_tahun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_tahun  $tb_tahun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_tahun $tb_tahun)
    {
        //
    }
}
