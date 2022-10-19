<?php

namespace App\Http\Controllers;

use App\Models\Tb_jenis_relawan;
use App\Models\Tb_relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbJenisRelawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tb_relawan $tb_relawan)
    {
        $relawan = Tb_relawan::find($tb_relawan->id);
        $relawans = Tb_jenis_relawan::where('id_relawan', $tb_relawan->id)->get();
        return view('admin.relawan.jenis', compact('relawan', 'relawans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tb_relawan $tb_relawan)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tb_relawan $tb_relawan)
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
        $jenis_relawan = new Tb_jenis_relawan();
        $jenis_relawan->id_relawan = $tb_relawan->id;
        $jenis_relawan->nama = $request->nama;
        $jenis_relawan->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/relawan/' . $tb_relawan->id . '/jenis');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_relawan  $tb_relawan
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_relawan $tb_relawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_relawan  $tb_relawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_relawan $tb_relawan, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_relawan  $tb_relawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_relawan $tb_relawan, $id)
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
        $jenis_relawan = Tb_jenis_relawan::find($id);
        $jenis_relawan->id_relawan = $tb_relawan->id;
        $jenis_relawan->nama = $request->nama;
        $jenis_relawan->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/relawan/' . $tb_relawan->id . '/jenis');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_relawan  $tb_relawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_relawan $tb_relawan, $id)
    {
        $jenis_relawan = Tb_jenis_relawan::findOrFail($id);
        $jenis_relawan->delete();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect('/admin/relawan/' . $tb_relawan->id . '/jenis');
    }
}
