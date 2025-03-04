<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="index.html" class="logo">
          <img src="{{ asset('assets/img/kaiadmin/bpkp_putih_logo.png') }}" alt="navbar brand" class="navbar-brand" height="50" />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item">
            <a href="{{ url(Auth::user()->getRoleNames()[0],'dashboard') }}">
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @if (Auth::user()->getRoleNames()[0] == 'admin')   
          <li class="nav-item">
            <a href="{{ url(Auth::user()->getRoleNames()[0],'pegawai') }}">
              <i class="fas fa-pen-square"></i>
              <p>Pegawai</p>
            </a>
          </li>
          @endif
          @if (Auth::user()->getRoleNames()[0] == 'atasan')   
          <li class="nav-item">
            <a href="#">
              <i class="fas fa-pen-square"></i>
              <p>Approve Aktivitas</p>
            </a>
          </li>
          @endif
          @if (Auth::user()->getRoleNames()[0] == 'atasan' || Auth::user()->getRoleNames()[0] == 'pegawai')
          <li class="nav-item">
            <a href="{{ url(Auth::user()->getRoleNames()[0],'aktivitas') }}">
              <i class="fas fa-pen-square"></i>
              <p>Aktivitas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url(Auth::user()->getRoleNames()[0],'skp') }}">
              <i class="fas fa-file"></i>
              <p>SKP</p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ url(Auth::user()->getRoleNames()[0],'rekap') }}">
              <i class="far fa-chart-bar"></i>
              <p>Rekap Aktivitas</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  