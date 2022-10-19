@extends('layouts.admin')

@section('ckeditor')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection

@section('js')
    <script src="{{ asset('assets/admin/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

    <script>
        $(".theSelect").select2();
    </script>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Halaman</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/admin/dashboard">
                        <i class="fa-solid fa-house-chimney"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/admin/halaman">Halaman</a>
                </li>
                <li class="separator">
                    <i class="fa-solid fa-chevron-right"></i>
                </li>
                <li class="nav-item">
                    <a href="">Tambah Halaman</a>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Halaman</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('halaman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Judul</label>
                        <div class="input-group ">
                            <input type="text" value="{{ old('judul') }}" placeholder="Masukkan Judul halaman"
                                name="judul" autocomplete='off' class="form-control @error('judul') is-invalid @enderror"
                                required>
                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Teks</label>
                        <textarea name="teks" id="ckeditor" autocomplete='off' class="form-control @error('teks') is-invalid @enderror"
                            cols="30" rows="8">{{ old('teks') }}</textarea>
                        @error('teks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Upload File Gambar</label>
                        <div class="custom-file mb-3">
                            <input type="file" id="file" name="gambar"
                                class="custom-file-input @error('gambar') is-invalid @enderror" accept="image/*"
                                onchange="tampilkanPreview(this,'preview')" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <img id="preview" src="" alt="" class="rounded img-fluid" />
                        @error('gambar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- Atas --}}
                    <div class="form-group row">
                        <div class="form-group col">
                            <label>Atas Kiri</label>
                            <div class="input-group ">

                                <select name="atas_kiri" required
                                    class="form-control form-control
                                theSelect"
                                    @error('atas_kiri') is-invalid @enderror>
                                    <option value="Tidak" {{ old('atas_kanan') == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ old('atas_kiri') == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ old('atas_kiri') == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Peta" {{ old('atas_kiri') == 'Peta' ? 'selected' : '' }}>Peta</option>
                                    <option value="SDM" {{ old('atas_kiri') == 'SDM' ? 'selected' : '' }}>SDM
                                    <option value="Kelembagaan" {{ old('atas_kiri') == 'Kelembagaan' ? 'selected' : '' }}>
                                        Kelembagaan</option>
                                    </option>
                                    <option value="Relawan" {{ old('atas_kiri') == 'Relawan' ? 'selected' : '' }}>
                                        Relawan
                                    </option>
                                    <option value="Sarpras" {{ old('atas_kiri') == 'Sarpras' ? 'selected' : '' }}>
                                        Sarpras
                                    </option>
                                    <option value="Regulasi/SOP"
                                        {{ old('atas_kiri') == 'Regulasi/SOP' ? 'selected' : '' }}>Regulasi/SOP
                                    </option>
                                    <option value="Kejadian Kebakaran"
                                        {{ old('atas_kiri') == 'Kejadian Kebakaran' ? 'selected' : '' }}>Kejadian
                                        Kebakaran
                                    </option>
                                    <option value="Kejadian Penyelematan"
                                        {{ old('atas_kiri') == 'Kejadian Penyelematan' ? 'selected' : '' }}>Kejadian
                                        Penyelematan
                                    </option>
                                    <option value="Kerjasama Daerah"
                                        {{ old('atas_kiri') == 'Kerjasama Daerah' ? 'selected' : '' }}>Kerjasama Daerah
                                    </option>
                                    <option value="SPM" {{ old('atas_kiri') == 'SPM' ? 'selected' : '' }}>SPM
                                    </option>
                                    <option value="Anggaran" {{ old('atas_kiri') == 'Anggaran' ? 'selected' : '' }}>
                                        Anggaran
                                    </option>
                                    <option value="Kontak" {{ old('atas_kiri') == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                </select>
                                @error('atas_kiri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Atas Tengah</label>
                            <div class="input-group ">

                                <select name="atas_tengah" required
                                    class="form-control form-control
                                theSelect"
                                    @error('atas_tengah') is-invalid @enderror>
                                    <option value="Tidak" {{ old('atas_tengah') == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ old('atas_tengah') == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ old('atas_tengah') == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Peta" {{ old('atas_tengah') == 'Peta' ? 'selected' : '' }}>Peta
                                    </option>
                                    <option value="SDM" {{ old('atas_tengah') == 'SDM' ? 'selected' : '' }}>SDM
                                    <option value="Kelembagaan"
                                        {{ old('atas_tengah') == 'Kelembagaan' ? 'selected' : '' }}>
                                        Kelembagaan</option>
                                    </option>
                                    <option value="Relawan" {{ old('atas_tengah') == 'Relawan' ? 'selected' : '' }}>
                                        Relawan
                                    </option>
                                    <option value="Sarpras" {{ old('atas_tengah') == 'Sarpras' ? 'selected' : '' }}>
                                        Sarpras
                                    </option>
                                    <option value="Regulasi/SOP"
                                        {{ old('atas_tengah') == 'Regulasi/SOP' ? 'selected' : '' }}>Regulasi/SOP
                                    </option>
                                    <option value="Kejadian Kebakaran"
                                        {{ old('atas_tengah') == 'Kejadian Kebakaran' ? 'selected' : '' }}>Kejadian
                                        Kebakaran
                                    </option>
                                    <option value="Kejadian Penyelematan"
                                        {{ old('atas_tengah') == 'Kejadian Penyelematan' ? 'selected' : '' }}>Kejadian
                                        Penyelematan
                                    </option>
                                    <option value="Kerjasama Daerah"
                                        {{ old('atas_tengah') == 'Kerjasama Daerah' ? 'selected' : '' }}>Kerjasama Daerah
                                    </option>
                                    <option value="SPM" {{ old('atas_tengah') == 'SPM' ? 'selected' : '' }}>SPM
                                    </option>
                                    <option value="Anggaran" {{ old('atas_tengah') == 'Anggaran' ? 'selected' : '' }}>
                                        Anggaran
                                    </option>
                                    <option value="Kontak" {{ old('atas_tengah') == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                </select>
                                @error('atas_tengah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Atas Kanan</label>
                            <div class="input-group ">

                                <select name="atas_kanan" required
                                    class="form-control form-control
                                theSelect"
                                    @error('atas_kanan') is-invalid @enderror>
                                    <option value="Tidak" {{ old('atas_kanan') == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ old('atas_kanan') == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ old('atas_kanan') == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Peta" {{ old('atas_kanan') == 'Peta' ? 'selected' : '' }}>Peta
                                    </option>
                                    <option value="SDM" {{ old('atas_kanan') == 'SDM' ? 'selected' : '' }}>SDM
                                    <option value="Kelembagaan"
                                        {{ old('atas_kanan') == 'Kelembagaan' ? 'selected' : '' }}>
                                        Kelembagaan</option>
                                    </option>
                                    <option value="Relawan" {{ old('atas_kanan') == 'Relawan' ? 'selected' : '' }}>
                                        Relawan
                                    </option>
                                    <option value="Sarpras" {{ old('atas_kanan') == 'Sarpras' ? 'selected' : '' }}>
                                        Sarpras
                                    </option>
                                    <option value="Regulasi/SOP"
                                        {{ old('atas_kanan') == 'Regulasi/SOP' ? 'selected' : '' }}>Regulasi/SOP
                                    </option>
                                    <option value="Kejadian Kebakaran"
                                        {{ old('atas_kanan') == 'Kejadian Kebakaran' ? 'selected' : '' }}>Kejadian
                                        Kebakaran
                                    </option>
                                    <option value="Kejadian Penyelematan"
                                        {{ old('atas_kanan') == 'Kejadian Penyelematan' ? 'selected' : '' }}>Kejadian
                                        Penyelematan
                                    </option>
                                    <option value="Kerjasama Daerah"
                                        {{ old('atas_kanan') == 'Kerjasama Daerah' ? 'selected' : '' }}>Kerjasama Daerah
                                    </option>
                                    <option value="SPM" {{ old('atas_kanan') == 'SPM' ? 'selected' : '' }}>SPM
                                    </option>
                                    <option value="Anggaran" {{ old('atas_kanan') == 'Anggaran' ? 'selected' : '' }}>
                                        Anggaran
                                    </option>
                                    <option value="Kontak" {{ old('atas_kanan') == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                </select>
                                @error('atas_kanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Tengah --}}
                    <div class="form-group row">
                        <div class="form-group col">
                            <label>Tengah Kiri</label>
                            <div class="input-group ">

                                <select name="tengah_kiri" required
                                    class="form-control form-control
                                theSelect"
                                    @error('tengah_kiri') is-invalid @enderror>
                                    <option value="Tidak" {{ old('tengah_kanan') == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ old('tengah_kiri') == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ old('tengah_kiri') == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Peta" {{ old('tengah_kiri') == 'Peta' ? 'selected' : '' }}>Peta
                                    </option>
                                    <option value="SDM" {{ old('tengah_kiri') == 'SDM' ? 'selected' : '' }}>SDM
                                    <option value="Kelembagaan"
                                        {{ old('tengah_kiri') == 'Kelembagaan' ? 'selected' : '' }}>
                                        Kelembagaan</option>
                                    </option>
                                    <option value="Relawan" {{ old('tengah_kiri') == 'Relawan' ? 'selected' : '' }}>
                                        Relawan
                                    </option>
                                    <option value="Sarpras" {{ old('tengah_kiri') == 'Sarpras' ? 'selected' : '' }}>
                                        Sarpras
                                    </option>
                                    <option value="Regulasi/SOP"
                                        {{ old('tengah_kiri') == 'Regulasi/SOP' ? 'selected' : '' }}>Regulasi/SOP
                                    </option>
                                    <option value="Kejadian Kebakaran"
                                        {{ old('tengah_kiri') == 'Kejadian Kebakaran' ? 'selected' : '' }}>Kejadian
                                        Kebakaran
                                    </option>
                                    <option value="Kejadian Penyelematan"
                                        {{ old('tengah_kiri') == 'Kejadian Penyelematan' ? 'selected' : '' }}>Kejadian
                                        Penyelematan
                                    </option>
                                    <option value="Kerjasama Daerah"
                                        {{ old('tengah_kiri') == 'Kerjasama Daerah' ? 'selected' : '' }}>Kerjasama Daerah
                                    </option>
                                    <option value="SPM" {{ old('tengah_kiri') == 'SPM' ? 'selected' : '' }}>SPM
                                    </option>
                                    <option value="Anggaran" {{ old('tengah_kiri') == 'Anggaran' ? 'selected' : '' }}>
                                        Anggaran
                                    </option>
                                    <option value="Kontak" {{ old('tengah_kiri') == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                </select>
                                @error('tengah_kiri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Tengah</label>
                            <div class="input-group ">

                                <select name="tengah" required
                                    class="form-control form-control
                                theSelect"
                                    @error('tengah') is-invalid @enderror>
                                    <option value="Tidak" {{ old('tengah') == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ old('tengah') == 'Slide' ? 'selected' : '' }}>Slide</option>
                                    <option value="Galeri" {{ old('tengah') == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Peta" {{ old('tengah') == 'Peta' ? 'selected' : '' }}>Peta</option>
                                    <option value="SDM" {{ old('tengah') == 'SDM' ? 'selected' : '' }}>SDM
                                    <option value="Kelembagaan" {{ old('tengah') == 'Kelembagaan' ? 'selected' : '' }}>
                                        Kelembagaan</option>
                                    </option>
                                    <option value="Relawan" {{ old('tengah') == 'Relawan' ? 'selected' : '' }}>
                                        Relawan
                                    </option>
                                    <option value="Sarpras" {{ old('tengah') == 'Sarpras' ? 'selected' : '' }}>
                                        Sarpras
                                    </option>
                                    <option value="Regulasi/SOP" {{ old('tengah') == 'Regulasi/SOP' ? 'selected' : '' }}>
                                        Regulasi/SOP
                                    </option>
                                    <option value="Kejadian Kebakaran"
                                        {{ old('tengah') == 'Kejadian Kebakaran' ? 'selected' : '' }}>Kejadian
                                        Kebakaran
                                    </option>
                                    <option value="Kejadian Penyelematan"
                                        {{ old('tengah') == 'Kejadian Penyelematan' ? 'selected' : '' }}>Kejadian
                                        Penyelematan
                                    </option>
                                    <option value="Kerjasama Daerah"
                                        {{ old('tengah') == 'Kerjasama Daerah' ? 'selected' : '' }}>Kerjasama Daerah
                                    </option>
                                    <option value="SPM" {{ old('tengah') == 'SPM' ? 'selected' : '' }}>SPM
                                    </option>
                                    <option value="Anggaran" {{ old('tengah') == 'Anggaran' ? 'selected' : '' }}>
                                        Anggaran
                                    </option>
                                    <option value="Kontak" {{ old('tengah') == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                </select>
                                @error('tengah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Tengah Kanan</label>
                            <div class="input-group ">

                                <select name="tengah_kanan" required
                                    class="form-control form-control
                                theSelect"
                                    @error('tengah_kanan') is-invalid @enderror>
                                    <option value="Tidak" {{ old('tengah_kanan') == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ old('tengah_kanan') == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ old('tengah_kanan') == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Peta" {{ old('tengah_kanan') == 'Peta' ? 'selected' : '' }}>Peta
                                    </option>
                                    <option value="SDM" {{ old('tengah_kanan') == 'SDM' ? 'selected' : '' }}>SDM
                                    <option value="Kelembagaan"
                                        {{ old('tengah_kanan') == 'Kelembagaan' ? 'selected' : '' }}>
                                        Kelembagaan</option>
                                    </option>
                                    <option value="Relawan" {{ old('tengah_kanan') == 'Relawan' ? 'selected' : '' }}>
                                        Relawan
                                    </option>
                                    <option value="Sarpras" {{ old('tengah_kanan') == 'Sarpras' ? 'selected' : '' }}>
                                        Sarpras
                                    </option>
                                    <option value="Regulasi/SOP"
                                        {{ old('tengah_kanan') == 'Regulasi/SOP' ? 'selected' : '' }}>Regulasi/SOP
                                    </option>
                                    <option value="Kejadian Kebakaran"
                                        {{ old('tengah_kanan') == 'Kejadian Kebakaran' ? 'selected' : '' }}>Kejadian
                                        Kebakaran
                                    </option>
                                    <option value="Kejadian Penyelematan"
                                        {{ old('tengah_kanan') == 'Kejadian Penyelematan' ? 'selected' : '' }}>Kejadian
                                        Penyelematan
                                    </option>
                                    <option value="Kerjasama Daerah"
                                        {{ old('tengah_kanan') == 'Kerjasama Daerah' ? 'selected' : '' }}>Kerjasama Daerah
                                    </option>
                                    <option value="SPM" {{ old('tengah_kanan') == 'SPM' ? 'selected' : '' }}>SPM
                                    </option>
                                    <option value="Anggaran" {{ old('tengah_kanan') == 'Anggaran' ? 'selected' : '' }}>
                                        Anggaran
                                    </option>
                                    <option value="Kontak" {{ old('tengah_kanan') == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                </select>
                                @error('tengah_kanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Bawah --}}
                    <div class="form-group row">
                        <div class="form-group col">
                            <label>Bawah Kiri</label>
                            <div class="input-group ">

                                <select name="bawah_kiri" required
                                    class="form-control form-control
                                theSelect"
                                    @error('bawah_kiri') is-invalid @enderror>
                                    <option value="Tidak" {{ old('bawah_kanan') == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ old('bawah_kiri') == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ old('bawah_kiri') == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Peta" {{ old('bawah_kiri') == 'Peta' ? 'selected' : '' }}>Peta
                                    </option>
                                    <option value="SDM" {{ old('bawah_kiri') == 'SDM' ? 'selected' : '' }}>SDM
                                    <option value="Kelembagaan"
                                        {{ old('bawah_kiri') == 'Kelembagaan' ? 'selected' : '' }}>
                                        Kelembagaan</option>
                                    </option>
                                    <option value="Relawan" {{ old('bawah_kiri') == 'Relawan' ? 'selected' : '' }}>
                                        Relawan
                                    </option>
                                    <option value="Sarpras" {{ old('bawah_kiri') == 'Sarpras' ? 'selected' : '' }}>
                                        Sarpras
                                    </option>
                                    <option value="Regulasi/SOP"
                                        {{ old('bawah_kiri') == 'Regulasi/SOP' ? 'selected' : '' }}>Regulasi/SOP
                                    </option>
                                    <option value="Kejadian Kebakaran"
                                        {{ old('bawah_kiri') == 'Kejadian Kebakaran' ? 'selected' : '' }}>Kejadian
                                        Kebakaran
                                    </option>
                                    <option value="Kejadian Penyelematan"
                                        {{ old('bawah_kiri') == 'Kejadian Penyelematan' ? 'selected' : '' }}>Kejadian
                                        Penyelematan
                                    </option>
                                    <option value="Kerjasama Daerah"
                                        {{ old('bawah_kiri') == 'Kerjasama Daerah' ? 'selected' : '' }}>Kerjasama Daerah
                                    </option>
                                    <option value="SPM" {{ old('bawah_kiri') == 'SPM' ? 'selected' : '' }}>SPM
                                    </option>
                                    <option value="Anggaran" {{ old('bawah_kiri') == 'Anggaran' ? 'selected' : '' }}>
                                        Anggaran
                                    </option>
                                    <option value="Kontak" {{ old('bawah_kiri') == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                </select>
                                @error('bawah_kiri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Bawah Tengah</label>
                            <div class="input-group ">

                                <select name="bawah_tengah" required
                                    class="form-control form-control
                                theSelect"
                                    @error('bawah_tengah') is-invalid @enderror>
                                    <option value="Tidak" {{ old('bawah_tengah') == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ old('bawah_tengah') == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ old('bawah_tengah') == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Peta" {{ old('bawah_tengah') == 'Peta' ? 'selected' : '' }}>Peta
                                    </option>
                                    <option value="SDM" {{ old('bawah_tengah') == 'SDM' ? 'selected' : '' }}>SDM
                                    <option value="Kelembagaan"
                                        {{ old('bawah_tengah') == 'Kelembagaan' ? 'selected' : '' }}>
                                        Kelembagaan</option>
                                    </option>
                                    <option value="Relawan" {{ old('bawah_tengah') == 'Relawan' ? 'selected' : '' }}>
                                        Relawan
                                    </option>
                                    <option value="Sarpras" {{ old('bawah_tengah') == 'Sarpras' ? 'selected' : '' }}>
                                        Sarpras
                                    </option>
                                    <option value="Regulasi/SOP"
                                        {{ old('bawah_tengah') == 'Regulasi/SOP' ? 'selected' : '' }}>Regulasi/SOP
                                    </option>
                                    <option value="Kejadian Kebakaran"
                                        {{ old('bawah_tengah') == 'Kejadian Kebakaran' ? 'selected' : '' }}>Kejadian
                                        Kebakaran
                                    </option>
                                    <option value="Kejadian Penyelematan"
                                        {{ old('bawah_tengah') == 'Kejadian Penyelematan' ? 'selected' : '' }}>Kejadian
                                        Penyelematan
                                    </option>
                                    <option value="Kerjasama Daerah"
                                        {{ old('bawah_tengah') == 'Kerjasama Daerah' ? 'selected' : '' }}>Kerjasama Daerah
                                    </option>
                                    <option value="SPM" {{ old('bawah_tengah') == 'SPM' ? 'selected' : '' }}>SPM
                                    </option>
                                    <option value="Anggaran" {{ old('bawah_tengah') == 'Anggaran' ? 'selected' : '' }}>
                                        Anggaran
                                    </option>
                                    <option value="Kontak" {{ old('bawah_tengah') == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                </select>
                                @error('bawah_tengah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col">
                            <label>Bawah Kanan</label>
                            <div class="input-group ">

                                <select name="bawah_kanan" required
                                    class="form-control form-control
                                theSelect"
                                    @error('bawah_kanan') is-invalid @enderror>
                                    <option value="Tidak" {{ old('bawah_kanan') == 'Tidak' ? 'selected' : '' }}>Tidak
                                        Ditampilkan</option>
                                    <option value="Slide" {{ old('bawah_kanan') == 'Slide' ? 'selected' : '' }}>Slide
                                    </option>
                                    <option value="Galeri" {{ old('bawah_kanan') == 'Galeri' ? 'selected' : '' }}>Galeri
                                    </option>
                                    <option value="Peta" {{ old('bawah_kanan') == 'Peta' ? 'selected' : '' }}>Peta
                                    </option>
                                    <option value="SDM" {{ old('bawah_kanan') == 'SDM' ? 'selected' : '' }}>SDM
                                    <option value="Kelembagaan"
                                        {{ old('bawah_kanan') == 'Kelembagaan' ? 'selected' : '' }}>
                                        Kelembagaan</option>
                                    </option>
                                    <option value="Relawan" {{ old('bawah_kanan') == 'Relawan' ? 'selected' : '' }}>
                                        Relawan
                                    </option>
                                    <option value="Sarpras" {{ old('bawah_kanan') == 'Sarpras' ? 'selected' : '' }}>
                                        Sarpras
                                    </option>
                                    <option value="Regulasi/SOP"
                                        {{ old('bawah_kanan') == 'Regulasi/SOP' ? 'selected' : '' }}>Regulasi/SOP
                                    </option>
                                    <option value="Kejadian Kebakaran"
                                        {{ old('bawah_kanan') == 'Kejadian Kebakaran' ? 'selected' : '' }}>Kejadian
                                        Kebakaran
                                    </option>
                                    <option value="Kejadian Penyelematan"
                                        {{ old('bawah_kanan') == 'Kejadian Penyelematan' ? 'selected' : '' }}>Kejadian
                                        Penyelematan
                                    </option>
                                    <option value="Kerjasama Daerah"
                                        {{ old('bawah_kanan') == 'Kerjasama Daerah' ? 'selected' : '' }}>Kerjasama Daerah
                                    </option>
                                    <option value="SPM" {{ old('bawah_kanan') == 'SPM' ? 'selected' : '' }}>SPM
                                    </option>
                                    <option value="Anggaran" {{ old('bawah_kanan') == 'Anggaran' ? 'selected' : '' }}>
                                        Anggaran
                                    </option>
                                    <option value="Kontak" {{ old('bawah_kanan') == 'Kontak' ? 'selected' : '' }}>
                                        Kontak
                                    </option>

                                </select>
                                @error('bawah_kanan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary text-white">
                            Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        function tampilkanPreview(gambar, idpreview) {
            var gb = gambar.files;
            for (var i = 0; i < gb.length; i++) {
                var gbPreview = gb[i];
                var imageType = /image.*/;
                var preview = document.getElementById(idpreview);
                var reader = new FileReader();

                if (gbPreview.type.match(imageType)) {
                    preview.file = gbPreview;
                    reader.onload = (function(element) {
                        return function(e) {
                            element.src = e.target.result;
                        };
                    })(preview);
                    reader.readAsDataURL(gbPreview);
                } else {
                    alert("file yang anda upload tidak sesuai. Khusus mengunakan image.");
                }

            }
        }
    </script>
@endsection
