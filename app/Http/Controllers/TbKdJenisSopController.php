<?php

namespace App\Http\Controllers;

use App\Models\Tb_kd_jenis_sop;
use App\Models\Tb_kerjasama_daerah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbKdJenisSopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tb_kerjasama_daerah $tb_kerjasama_daerah)
    {
        $kerjasamaDaerah = Tb_kerjasama_daerah::find($tb_kerjasama_daerah->id);
        $sop = Tb_kd_jenis_sop::where('id_kerjasama_daerah', $tb_kerjasama_daerah->id)->get();
        return view('admin.kerjasama-daerah.jenis-sop', compact('kerjasamaDaerah', 'sop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tb_kerjasama_daerah $tb_kerjasama_daerah)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tb_kerjasama_daerah $tb_kerjasama_daerah)
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
        $jenis_sop = new Tb_kd_jenis_sop();
        $jenis_sop->id_kerjasama_daerah = $tb_kerjasama_daerah->id;
        $jenis_sop->nama = $request->nama;
        $jenis_sop->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/kerjasama-daerah/' . $tb_kerjasama_daerah->id . '/jenis-sop');
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
    public function edit(Tb_kerjasama_daerah $tb_kerjasama_daerah, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kerjasama_daerah  $tb_kerjasama_daerah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_kerjasama_daerah $tb_kerjasama_daerah, $id)
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
        $jenis_sop = Tb_kd_jenis_sop::find($id);
        $jenis_sop->id_kerjasama_daerah = $tb_kerjasama_daerah->id;
        $jenis_sop->nama = $request->nama;
        $jenis_sop->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect('/admin/kerjasama-daerah/' . $tb_kerjasama_daerah->id . '/jenis-sop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kerjasama_daerah  $tb_kerjasama_daerah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_kerjasama_daerah $tb_kerjasama_daerah, $id)
    {
        $jenis_sop = Tb_kd_jenis_sop::findOrFail($id);
        $jenis_sop->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect('/admin/kerjasama-daerah/' . $tb_kerjasama_daerah->id . '/jenis-sop');
    }
}
