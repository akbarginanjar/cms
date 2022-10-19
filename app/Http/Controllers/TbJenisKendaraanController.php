<?php

namespace App\Http\Controllers;

use App\Models\Tb_jenis_kendaraan;
use App\Models\Tb_sarpras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbJenisKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tb_sarpras $tb_sarpras)
    {
        $sarpras = Tb_sarpras::find($tb_sarpras->id);
        $jenisKendaraan = Tb_jenis_kendaraan::where('id_sarpras', $tb_sarpras->id)->get();
        return view('admin.sarpras.jenis-kendaraan', compact('sarpras', 'jenisKendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tb_sarpras $tb_sarpras)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tb_sarpras $tb_sarpras)
    {
        $rules = [
            'nama' => 'required',
            'jumlah' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $jenis_kendaraan = new Tb_jenis_kendaraan();
        $jenis_kendaraan->id_sarpras = $tb_sarpras->id;
        $jenis_kendaraan->nama = $request->nama;
        $jenis_kendaraan->jumlah = $request->jumlah;
        $jenis_kendaraan->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/sarpras/' . $tb_sarpras->id . '/jenis-kendaraan');
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
    public function edit(Tb_sarpras $tb_sarpras, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_sarpras  $tb_sarpras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_sarpras $tb_sarpras, $id)
    {
        $rules = [
            'nama' => 'required',
            'jumlah' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $jenis_kendaraan = Tb_jenis_kendaraan::find($id);
        $jenis_kendaraan->nama = $request->nama;
        $jenis_kendaraan->jumlah = $request->jumlah;
        $jenis_kendaraan->save();
        session()->put('success', 'Data Berhasil diedit');
        return redirect('/admin/sarpras/' . $tb_sarpras->id . '/jenis-kendaraan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_sarpras  $tb_sarpras
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_sarpras $tb_sarpras, $id)
    {
        $jenis_sarpras = Tb_jenis_kendaraan::findOrFail($id);
        $jenis_sarpras->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect('/admin/sarpras/' . $tb_sarpras->id . '/jenis-kendaraan');
    }
}
