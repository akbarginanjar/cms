  @php
      use App\Models\Tb_setting;
      use App\Models\Tb_menu;
      use App\Models\Tb_submenu;
      $setting = Tb_setting::find(1);
      $menu = Tb_menu::orderBy('urutan', 'asc')->get();
  @endphp
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
      <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

          <a href="/" class="logo d-flex align-items-center">
              {{-- <img src="assets/img/logo.png" alt=""> --}}
              <span>{{ $setting->judul }}</span>
          </a>

          <nav id="navbar" class="navbar">
              <ul>
                  @foreach ($menu as $item)
                      @if ($item->id_konten === 0)
                          <li class="dropdown"><a href="#"><span>{{ $item->nama }}</span> <i
                                      class="bi bi-chevron-down"></i></a>
                              <ul>
                                  <li>
                                      @php
                                          $submenu = Tb_submenu::orderBy('urutan', 'asc')
                                              ->where('id_menu', $item->id)
                                              ->get();
                                      @endphp
                                      @foreach ($submenu as $data)
                                          <a href="/s=>{{ $data->slug }}">{{ $data->nama }}</a>
                                      @endforeach
                                  </li>
                              </ul>
                          </li>
                      @else
                          <li><a class="nav-link scrollto" href="/m=>{{ $item->slug }} ">{{ $item->nama }}</a></li>
                      @endif
                  @endforeach
                  <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

      </div>
  </header><!-- End Header -->
