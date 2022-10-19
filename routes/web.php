<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TbArtikelController;
use App\Http\Controllers\TbGaleriController;
use App\Http\Controllers\TbHalamanController;
use App\Http\Controllers\TbKategoriArtikelController;
use App\Http\Controllers\TbKategoriGaleriController;
use App\Http\Controllers\TbKategoriKegiatanController;
use App\Http\Controllers\TbKegiatanController;
use App\Http\Controllers\TbMenuController;
use App\Http\Controllers\TbPenggunaController;
use App\Http\Controllers\TbPetaController;
use App\Http\Controllers\TbSettingController;
use App\Http\Controllers\TbSlideController;
use App\Http\Controllers\TbSubmenuController;
use App\Http\Controllers\TbWilayahController;
use App\Http\Controllers\TbSdmController;
use App\Http\Controllers\TbSpmController;
use App\Http\Controllers\TbAnggaranController;
use App\Http\Controllers\TbContactController;
use App\Http\Controllers\TbJenisApdController;
use App\Http\Controllers\TbJenisKendaraanController;
use App\Http\Controllers\TbJenisPenyelamatanController;
use App\Http\Controllers\TbJenisRegulasiController;
use App\Http\Controllers\TbJenisRelawanController;
use App\Http\Controllers\TbJenisSopController;
use App\Http\Controllers\TbJenisTerbakarController;
use App\Http\Controllers\TbKdJenisRegulasiController;
use App\Http\Controllers\TbKdJenisSopController;
use App\Http\Controllers\TbKejadianKebakaranController;
use App\Http\Controllers\TbKejadianPenyelamatanController;
use App\Http\Controllers\TbKelembagaanController;
use App\Http\Controllers\TbKerjasamaDaerahController;
use App\Http\Controllers\TbRegulasiSopController;
use App\Http\Controllers\TbRelawanController;
use App\Http\Controllers\TbSarprasController;
use App\Http\Controllers\TbTahunAnggaranController;
use App\Http\Controllers\TbTahunController;
use App\Http\Controllers\TbTahunSpmController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PublicController::class, 'welcome']);
Route::get('/m=>{tb_menu:slug}', [PublicController::class, 'menu']);
Route::get('/s=>{tb_submenu:slug}', [PublicController::class, 'submenu']);
Route::get('/galeri/{tb_kategori_galeri:slug}', [PublicController::class, 'galeri']);

Route::get('/contact', function () {
    return view('member.contact');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/admin/login', [LoginAdminController::class, 'index'])->name('login')->middleware('guest');
Route::post('/admin/login/proses', [LoginAdminController::class, 'authenticate']);
Route::get('geoportal', [TbPetaController::class, 'geo']);
Route::get('/geoportal/{tb_petas:id}', [TbPetaController::class, 'detail']);
// Route Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('logout', [LoginAdminController::class, 'logout']);
    Route::get('/', function () {
        return redirect("admin/dashboard");
    });
    Route::get('dashboard', [AdminController::class, 'index']);
    Route::resource('kategori-artikel', TbKategoriArtikelController::class);
    Route::resource('kategori-kegiatan', TbKategoriKegiatanController::class);
    Route::resource('kategori-galeri', TbKategoriGaleriController::class);
    Route::resource('artikel', TbArtikelController::class);
    Route::resource('sdm', TbSdmController::class);
    Route::resource('kontak', TbContactController::class);
    Route::resource('kelembagaan', TbKelembagaanController::class);
    Route::resource('kegiatan', TbKegiatanController::class);
    Route::resource('halaman', TbHalamanController::class);
    Route::resource('menu', TbMenuController::class);
    Route::resource('relawan', TbRelawanController::class);
    Route::resource('sarpras', TbSarprasController::class);
    Route::resource('regulasi-sop', TbRegulasiSopController::class);
    Route::resource('kerjasama-daerah', TbKerjasamaDaerahController::class);
    Route::resource('kejadian-kebakaran', TbKejadianKebakaranController::class);
    Route::resource('kejadian-penyelamatan', TbKejadianPenyelamatanController::class);
    Route::get('spm', [TbSpmController::class, 'index']);
    Route::get('anggaran', [TbAnggaranController::class, 'index']);
    // Route::resource('submenu', TbSubmenuController::class);
    Route::get('menu/{tb_menu:slug}/submenu', [TbSubMenuController::class, 'index']);
    Route::get('menu/{tb_menu:slug}/submenu/create', [TbSubMenuController::class, 'create']);
    Route::post('menu/{tb_menu:slug}/submenu/store', [TbSubMenuController::class, 'store']);
    Route::get('menu/{tb_menu:slug}/submenu/{id}/edit', [TbSubMenuController::class, 'edit']);
    Route::post('menu/{tb_menu:slug}/submenu/{id}/update', [TbSubMenuController::class, 'update']);
    Route::post('menu/{tb_menu:slug}/submenu/{id}/destroy', [TbSubMenuController::class, 'destroy']);
    Route::resource('slide', TbSlideController::class);
    Route::resource('galeri', TbGaleriController::class);
    Route::resource('wilayah', TbWilayahController::class);
    Route::resource('pengguna', TbPenggunaController::class);
    Route::resource('peta', TbPetaController::class);
    Route::post('urutan/{id}/atas', [TbMenuController::class, 'atas']);
    Route::post('urutan/{id}/bawah', [TbMenuController::class, 'bawah']);
    Route::post('menu/{tb_menu:slug}/submenu/urutan/{id}/atas', [TbSubMenuController::class, 'atas']);
    Route::post('menu/{tb_menu:slug}/submenu/urutan/{id}/bawah', [TbSubMenuController::class, 'bawah']);
    Route::get('setting', [TbSettingController::class, 'index']);
    Route::get('setting', [TbSettingController::class, 'index']);
    Route::post('setting/judul', [TbSettingController::class, 'judul']);
    Route::post('setting/lokasi', [TbSettingController::class, 'lokasi']);
    Route::post('setting/medsos', [TbSettingController::class, 'medsos']);
    Route::post('{id}/uaktif', [TbPenggunaController::class, 'statusAktif']);
    Route::post('{id}/unonaktif', [TbPenggunaController::class, 'statusNonaktif']);
    Route::post('upload', [TbArtikelController::class, 'upload'])->name('upload');
    Route::get('urutan', [TbMenuController::class, 'urutan']);
    Route::get('urutan/{id}', [TbMenuController::class, 'urutanedit']);
    Route::post('urutan/{id}/proses', [TbMenuController::class, 'urutanproses']);
    Route::get('profile', [TbPenggunaController::class, 'profile']);
    Route::post('profile/{id}/edit', [TbPenggunaController::class, 'profileEdit']);
    Route::get('akun', [TbPenggunaController::class, 'akun']);
    Route::post('akun/{id}/edit', [TbPenggunaController::class, 'akunEdit']);

    //==================== Data Informasi =================//

    Route::post('spm/tahun', [TbTahunController::class, 'store']);
    // SPM
    Route::get('spm/{tb_spm:id}/data', [TbTahunSpmController::class, 'index']);
    Route::post('spm/{tb_spm:id}/{id}/edit', [TbTahunSpmController::class, 'update']);

    // Anggaran
    Route::get('anggaran/{tb_anggaran:id}/data', [TbTahunAnggaranController::class, 'index']);
    Route::post('anggaran/{tb_anggaran:id}/{id}/edit', [TbTahunAnggaranController::class, 'update']);

    // Relawan
    Route::get('relawan/{tb_relawan:id}/jenis', [TbJenisRelawanController::class, 'index']);
    Route::post('relawan/{tb_relawan:id}/tambah', [TbJenisRelawanController::class, 'store']);
    Route::post('relawan/{tb_relawan:id}/{id}/edit', [TbJenisRelawanController::class, 'update']);
    Route::post('relawan/{tb_relawan:id}/{id}/destroy', [TbJenisRelawanController::class, 'destroy']);

    // Kejadian Kebakaran
    Route::get('kejadian-kebakaran/{tb_kejadian_kebakaran:id}/jenis', [TbJenisTerbakarController::class, 'index']);
    Route::post('kejadian-kebakaran/{tb_kejadian_kebakaran:id}/tambah', [TbJenisTerbakarController::class, 'store']);
    Route::post('kejadian-kebakaran/{tb_kejadian_kebakaran:id}/{id}/edit', [TbJenisTerbakarController::class, 'update']);
    Route::post('kejadian-kebakaran/{tb_kejadian_kebakaran:id}/{id}/destroy', [TbJenisTerbakarController::class, 'destroy']);

    // Kejadian Penyelamatan
    Route::get('kejadian-penyelamatan/{tb_kejadian_penyelamatan:id}/jenis', [TbJenisPenyelamatanController::class, 'index']);
    Route::post('kejadian-penyelamatan/{tb_kejadian_penyelamatan:id}/tambah', [TbJenisPenyelamatanController::class, 'store']);
    Route::post('kejadian-penyelamatan/{tb_kejadian_penyelamatan:id}/{id}/edit', [TbJenisPenyelamatanController::class, 'update']);
    Route::post('kejadian-penyelamatan/{tb_kejadian_penyelamatan:id}/{id}/destroy', [TbJenisPenyelamatanController::class, 'destroy']);

    // Sarpras
    // Jenis Kendaraan
    Route::get('sarpras/{tb_sarpras:id}/jenis-kendaraan', [TbJenisKendaraanController::class, 'index']);
    Route::post('sarpras/{tb_sarpras:id}/jenis-kendaraan/tambah', [TbJenisKendaraanController::class, 'store']);
    Route::post('sarpras/{tb_sarpras:id}/jenis-kendaraan/{id}/edit', [TbJenisKendaraanController::class, 'update']);
    Route::post('sarpras/{tb_sarpras:id}/jenis-kendaraan/{id}/destroy', [TbJenisKendaraanController::class, 'destroy']);
    // Jenis Apd
    Route::get('sarpras/{tb_sarpras:id}/jenis-apd', [TbJenisApdController::class, 'index']);
    Route::post('sarpras/{tb_sarpras:id}/jenis-apd/tambah', [TbJenisApdController::class, 'store']);
    Route::post('sarpras/{tb_sarpras:id}/jenis-apd/{id}/edit', [TbJenisApdController::class, 'update']);
    Route::post('sarpras/{tb_sarpras:id}/jenis-apd/{id}/destroy', [TbJenisApdController::class, 'destroy']);

    // Regulasi/SOP
    // Jenis Regulasi
    Route::get('regulasi-sop/{tb_regulasi_sop:id}/jenis-regulasi', [TbJenisRegulasiController::class, 'index']);
    Route::post('regulasi-sop/{tb_regulasi_sop:id}/jenis-regulasi/tambah', [TbJenisRegulasiController::class, 'store']);
    Route::post('regulasi-sop/{tb_regulasi_sop:id}/jenis-regulasi/{id}/edit', [TbJenisRegulasiController::class, 'update']);
    Route::post('regulasi-sop/{tb_regulasi_sop:id}/jenis-regulasi/{id}/destroy', [TbJenisRegulasiController::class, 'destroy']);
    // Jenis SOP
    Route::get('regulasi-sop/{tb_regulasi_sop:id}/jenis-sop', [TbJenisSopController::class, 'index']);
    Route::post('regulasi-sop/{tb_regulasi_sop:id}/jenis-sop/tambah', [TbJenisSopController::class, 'store']);
    Route::post('regulasi-sop/{tb_regulasi_sop:id}/jenis-sop/{id}/edit', [TbJenisSopController::class, 'update']);
    Route::post('regulasi-sop/{tb_regulasi_sop:id}/jenis-sop/{id}/destroy', [TbJenisSopController::class, 'destroy']);

    // Kerjasama Daerah
    // Jenis Regulasi
    Route::get('kerjasama-daerah/{tb_kerjasama_daerah:id}/jenis-regulasi', [TbKdJenisRegulasiController::class, 'index']);
    Route::post('kerjasama-daerah/{tb_kerjasama_daerah:id}/jenis-regulasi/tambah', [TbKdJenisRegulasiController::class, 'store']);
    Route::post('kerjasama-daerah/{tb_kerjasama_daerah:id}/jenis-regulasi/{id}/edit', [TbKdJenisRegulasiController::class, 'update']);
    Route::post('kerjasama-daerah/{tb_kerjasama_daerah:id}/jenis-regulasi/{id}/destroy', [TbKdJenisRegulasiController::class, 'destroy']);
    // Jenis SOP
    Route::get('kerjasama-daerah/{tb_kerjasama_daerah:id}/jenis-sop', [TbKdJenisSopController::class, 'index']);
    Route::post('kerjasama-daerah/{tb_kerjasama_daerah:id}/jenis-sop/tambah', [TbKdJenisSopController::class, 'store']);
    Route::post('kerjasama-daerah/{tb_kerjasama_daerah:id}/jenis-sop/{id}/edit', [TbKdJenisSopController::class, 'update']);
    Route::post('kerjasama-daerah/{tb_kerjasama_daerah:id}/jenis-sop/{id}/destroy', [TbKdJenisSopController::class, 'destroy']);
});
Route::post('contact/store', [TbContactController::class, 'store'])->name('contact.store');


Auth::routes([
    'register' => false,
    'login' => false
]);
