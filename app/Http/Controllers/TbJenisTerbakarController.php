<?php

namespace App\Http\Controllers;

use App\Models\Tb_jenis_terbakar;
use App\Models\Tb_kejadian_kebakaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TbJenisTerbakarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tb_kejadian_kebakaran $tb_kejadian_kebakaran)
    {
        $kejadianKebakaran = Tb_kejadian_kebakaran::find($tb_kejadian_kebakaran->id);
        $jenis = Tb_jenis_terbakar::where('id_kejadian_kebakaran', $tb_kejadian_kebakaran->id)->get();
        return view('admin.kejadian-kebakaran.jenis', compact('kejadianKebakaran', 'jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tb_kejadian_kebakaran $tb_kejadian_kebakaran)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tb_kejadian_kebakaran $tb_kejadian_kebakaran)
    {
        $rules = [
            'nama' => 'required',
            'jumlah' => 'required',
            'penyebab' => 'required',
            'asumsi_kerugian' => 'required',
            'asumsi_pemadaman' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $jenis_terbakar = new Tb_jenis_terbakar();
        $jenis_terbakar->id_kejadian_kebakaran = $tb_kejadian_kebakaran->id;
        $jenis_terbakar->nama = $request->nama;
        $jenis_terbakar->jumlah = $request->jumlah;
        $jenis_terbakar->penyebab = $request->penyebab;
        $jenis_terbakar->asumsi_kerugian = $request->asumsi_kerugian;
        $jenis_terbakar->asumsi_pemadaman = $request->asumsi_pemadaman;
        $jenis_terbakar->save();

        $kejadianKebakaran = Tb_kejadian_kebakaran::find($tb_kejadian_kebakaran->id);
        $kejadianKebakaran->jml_kejadian = $kejadianKebakaran->jml_kejadian + $jenis_terbakar->jumlah;
        $kejadianKebakaran->asumsi_rugi = $kejadianKebakaran->asumsi_rugi + $jenis_terbakar->asumsi_kerugian;
        $kejadianKebakaran->asumsi_selamat = $kejadianKebakaran->asumsi_selamat + $jenis_terbakar->asumsi_pemadaman;
        $kejadianKebakaran->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/kejadian-kebakaran/' . $tb_kejadian_kebakaran->id . '/jenis');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tb_kejadian_kebakaran  $tb_kejadian_kebakaran
     * @return \Illuminate\Http\Response
     */
    public function show(Tb_kejadian_kebakaran $tb_kejadian_kebakaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tb_kejadian_kebakaran  $tb_kejadian_kebakaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Tb_kejadian_kebakaran $tb_kejadian_kebakaran, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tb_kejadian_kebakaran  $tb_kejadian_kebakaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tb_kejadian_kebakaran $tb_kejadian_kebakaran, $id)
    {
        $rules = [
            'nama' => 'required',
            'jumlah' => 'required',
            'penyebab' => 'required',
            'asumsi_kerugian' => 'required',
            'asumsi_pemadaman' => 'required',
        ];

        $message = [
            'required' => 'Data wajib diisi!',
        ];

        $validation = Validator::make($request->all(), $rules, $message);
        if ($validation->fails()) {
            session()->put('danger', 'Data yang anda input tidak valid, silahkan di ulang');
            return back()->withErrors($validation)->withInput();
        }
        $jenis_terbakarOld = Tb_jenis_terbakar::find($id);
        $jenis_terbakar = Tb_jenis_terbakar::find($id);
        $jenis_terbakar->nama = $request->nama;
        $jenis_terbakar->jumlah = $request->jumlah;
        $jenis_terbakar->penyebab = $request->penyebab;
        $jenis_terbakar->asumsi_kerugian = $request->asumsi_kerugian;
        $jenis_terbakar->asumsi_pemadaman = $request->asumsi_pemadaman;
        $jenis_terbakar->save();

        $kejadianKebakaran = Tb_kejadian_kebakaran::find($tb_kejadian_kebakaran->id);
        $kejadianKebakaran->jml_kejadian = ($kejadianKebakaran->jml_kejadian - $jenis_terbakarOld->jumlah) + $jenis_terbakar->jumlah;
        $kejadianKebakaran->asumsi_rugi = ($kejadianKebakaran->asumsi_rugi - $jenis_terbakarOld->asumsi_kerugian) + $jenis_terbakar->asumsi_kerugian;
        $kejadianKebakaran->asumsi_selamat = ($kejadianKebakaran->asumsi_selamat - $jenis_terbakarOld->asumsi_pemadaman) + $jenis_terbakar->asumsi_pemadaman;
        $kejadianKebakaran->save();
        session()->put('success', 'Data Berhasil ditambahkan');
        return redirect('/admin/kejadian-kebakaran/' . $tb_kejadian_kebakaran->id . '/jenis');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tb_kejadian_kebakaran  $tb_kejadian_kebakaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tb_kejadian_kebakaran $tb_kejadian_kebakaran, $id)
    {
        $jenis_terbakarOld = Tb_jenis_terbakar::find($id);

        $jenis_terbakar = Tb_jenis_terbakar::findOrFail($id);
        $jenis_terbakar->delete();

        $kejadianKebakaran = Tb_kejadian_kebakaran::find($tb_kejadian_kebakaran->id);
        $kejadianKebakaran->jml_kejadian = $kejadianKebakaran->jml_kejadian - $jenis_terbakarOld->jumlah;
        $kejadianKebakaran->asumsi_rugi = $kejadianKebakaran->asumsi_rugi - $jenis_terbakarOld->asumsi_kerugian;
        $kejadianKebakaran->asumsi_selamat = $kejadianKebakaran->asumsi_selamat - $jenis_terbakarOld->asumsi_pemadaman;
        $kejadianKebakaran->save();
        session()->put('success', 'Data Berhasil dihapus');
        return redirect('/admin/kejadian-kebakaran/' . $tb_kejadian_kebakaran->id . '/jenis');
    }
}
