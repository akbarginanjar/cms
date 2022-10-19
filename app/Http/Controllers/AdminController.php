<?php

namespace App\Http\Controllers;

use App\Models\Tb_halaman;
use App\Models\Tb_artikel;
use App\Models\Tb_kegiatan;
use App\Models\Tb_menu;
use App\Models\Tb_submenu;
use App\Models\Tb_transaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dataHalaman = Tb_halaman::count();
        $dataArtikel = Tb_artikel::count();
        $dataKegiatan = Tb_kegiatan::count();
        $menu = Tb_menu::count();
        $subMenu = Tb_submenu::count();
        return view('admin.index', compact('dataHalaman', 'dataArtikel', 'dataKegiatan', 'menu', 'subMenu'));
    }

    public function login()
    {
        return view('admin.login');
    }
}
