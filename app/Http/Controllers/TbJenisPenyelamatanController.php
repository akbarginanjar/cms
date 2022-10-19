<?php

namespace App\Http\Controllers;

use App\Models\Tb_jenis_penyelamatan;
use App\Models\Tb_kejadian_penyelamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbJenisPenyelamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan)
    {
        $kejadianPenyelamatan = Tb_kejadian_penyelamatan::find($tb_kejadian_penyelamatan->id);
        $jenis = Tb_jenis_penyelamatan::where('id_kejadian_penyelamatan', $tb_kejadian_penyelamatan->id)->get();
        return view('admin.kejadian-penyelamatan.jenis', compact('kejadianPenyelamatan', 'jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan)
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
        $jenis_penyelamatan = new Tb_jenis_penyelamatan();
        $jenis_penyelamatan->id_kejadian_penyelamatan = $tb_kejadian_penyelamatan->id;
        $jenis_penyelamatan->nama = $request->nama;
        $jenis_penyelamatan->jumlah = $request->jumlah;
        $jenis_penyelamatan->save();

        $kejadianPenyelamatan = Tb_kejadian_penyelamatan::find($tb_kejadian_penyelamatan->id);
        $kejadianPenyelamatan->total_selamat = $kejadianPenyelamatan->total_selamat + $jenis_penyelamatan->jumlah;
        $kejadianPenyelamatan->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/kejadian-penyelamatan/' . $tb_kejadian_penyelamatan->id . '/jenis');
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
    public function edit(Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kejadian_penyelamatan  $tb_kejadian_penyelamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan, $id)
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
        $jenis_penyelamatanOld = Tb_jenis_penyelamatan::find($id);
        $jenis_penyelamatan = Tb_jenis_penyelamatan::find($id);
        $jenis_penyelamatan->nama = $request->nama;
        $jenis_penyelamatan->jumlah = $request->jumlah;
        $jenis_penyelamatan->save();

        $kejadianPenyelamatan = Tb_kejadian_penyelamatan::find($tb_kejadian_penyelamatan->id);
        $kejadianPenyelamatan->total_selamat = ($kejadianPenyelamatan->total_selamat - $jenis_penyelamatanOld->jumlah) + $jenis_penyelamatan->jumlah;
        $kejadianPenyelamatan->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/kejadian-penyelamatan/' . $tb_kejadian_penyelamatan->id . '/jenis');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kejadian_penyelamatan  $tb_kejadian_penyelamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_kejadian_penyelamatan $tb_kejadian_penyelamatan, $id)
    {
        $jenis_penyelamatanOld = Tb_jenis_penyelamatan::find($id);

        $jenis_penyelamatan = Tb_jenis_penyelamatan::findOrFail($id);
        $jenis_penyelamatan->delete();

        $kejadianPenyelamatan = Tb_kejadian_penyelamatan::find($tb_kejadian_penyelamatan->id);
        $kejadianPenyelamatan->total_selamat = $kejadianPenyelamatan->total_selamat - $jenis_penyelamatanOld->jumlah;
        $kejadianPenyelamatan->save();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect('/admin/kejadian-penyelamatan/' . $tb_kejadian_penyelamatan->id . '/jenis');
    }
}
