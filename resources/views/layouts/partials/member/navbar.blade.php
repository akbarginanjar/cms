<!-- Navbar Start -->
<?php
use App\Models\Tb_menu;
use App\Models\Tb_submenu;
use App\Models\Tb_setting;
$setting = Tb_setting::find(1);
$menu = Tb_menu::orderBy('urutan', 'asc')->get();
?>
<nav class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="#" class="navbar-brand ms-3 d-lg-none">
        <p class="fw-bold text-white m-0 text-uppercase"><img src="{{ $setting->icon() }}" width="40px" alt="Logo Damkar">
        </p>
    </a>
    <button type="button" class="navbar-toggler me-3" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav me-auto p-3 p-lg-0">
            {{-- <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active text-warning' : '' }}">Beranda</a> --}}
            @foreach ($menu as $item)
                @if ($item->id_konten === 0)
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown">{{ $item->nama }}</a>
                        <div class="dropdown-menu border-0 shadow rounded-0 rounded-bottom m-0">
                            @php
                                $submenu = Tb_submenu::orderBy('urutan', 'asc')
                                    ->where('id_menu', $item->id)
                                    ->get();
                            @endphp
                            @foreach ($submenu as $data)
                                <a href="/s=>{{ $data->slug }}"
                                    class="dropdown-item {{ Request::is('') ? 'active text-warning' : '' }}">{{ $data->nama }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="/m=>{{ $item->slug }}"
                        class="nav-item nav-link {{ Request::is('/m=>saha') ? 'active text-warning' : '' }}">{{ $item->nama }}</a>
                @endif
            @endforeach
        </div>
        {{-- <a href="#" class="btn btn-sm btn-light rounded-pill py-2 px-4 d-none d-lg-block">Get Started</a> --}}
    </div>
</nav>
<!-- Navbar End -->
