<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme shadow rounded-3 p-2">
    <div class="app-brand demo d-flex align-items-center mb-3">
        <a href="{{ Auth::user()->role == 'admin' ? route('admin.index') : route('siswa.index') }}" class="app-brand-link d-flex align-items-center text-decoration-none">
            <img src="{{ asset('assets/img/logo110.png') }}" alt="Logo" style="height: 40px;" class="me-2">
            <span class="app-brand-text fw-bold fs-4">SPK</span>
        </a>
    </div>
    <ul class="menu-inner py-1">

        {{-- DASHBOARD --}}
        {{-- <li class="menu-item {{ request()->routeIs(Auth::user()->role.'.index') ? 'active' : '' }}">
            <a href="{{ route(Auth::user()->role.'.index') }}" class="menu-link text-decoration-none d-flex align-items-center">
                <i class="menu-icon tf-icons bx bx-home-circle me-2"></i>
                <span>Dashboard</span>
            </a>
        </li> --}}
        @if(Auth::user()->role == 'siswa')
            {{-- Khusus untuk role siswa --}}
             <li class="menu-item {{ request()->routeIs('siswas.index') ? 'active' : '' }}">
             <a href="{{ route('siswas.index') }}" class="menu-link text-decoration-none d-flex align-items-center">
            <i class="menu-icon tf-icons bx bx-home-circle me-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @else
            {{-- Untuk semua role selain siswa (logika asli Anda) --}}
            <li class="menu-item {{ request()->routeIs(Auth::user()->role.'.index') ? 'active' : '' }}">
                <a href="{{ route(Auth::user()->role.'.index') }}" class="menu-link text-decoration-none d-flex align-items-center">
                    <i class="menu-icon tf-icons bx bx-home-circle me-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endif

        {{-- ADMIN MENU --}}
        @if (Auth::user()->role == 'admin')
            <li class="menu-header small text-uppercase mb-2 mt-3">
                <span class="menu-header-text text-secondary">Master Data</span>
            </li>
                <li class="menu-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                <a href="{{ route('siswa.index') }}" class="menu-link text-decoration-none d-flex align-items-center">
                    <i class="menu-icon tf-icons bx bx-user me-2"></i>
                    <span>Siswa</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('alternatif.*') ? 'active' : '' }}">
                <a href="{{ route('alternatif.index') }}" class="menu-link text-decoration-none d-flex align-items-center">
                    <i class="menu-icon tf-icons bx bx-dock-top me-2"></i>
                    <span>Alternatif</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('kriteria.*') ? 'active' : '' }}">
                <a href="{{ route('kriteria.index') }}" class="menu-link text-decoration-none d-flex align-items-center">
                    <i class="menu-icon tf-icons bx bx-box me-2"></i>
                    <span>Kriteria</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('sub_kriteria.*') ? 'active' : '' }}">
                <a href="{{ route('sub_kriteria.index') }}" class="menu-link text-decoration-none d-flex align-items-center">
                    <i class="menu-icon tf-icons bx bx-collection me-2"></i>
                    <span>Sub Kriteria</span>
                </a>
            </li>
            <li class="menu-header small text-uppercase mb-2 mt-3">
                <span class="menu-header-text text-secondary">Perhitungan</span>
            </li>
            <li class="menu-item {{ request()->routeIs('penilaian.*') ? 'active' : '' }}">
                <a href="{{ route('penilaian.index') }}" class="menu-link text-decoration-none d-flex align-items-center">
                    <i class="menu-icon tf-icons bx bx-cube-alt me-2"></i>
                    <span>Penilaian</span>
                </a>
            </li>
            <li class="menu-item {{ request()->routeIs('penilaiansiswa.*') ? 'active' : '' }}">
                <a href="{{ route('penilaiansiswa.index') }}" class="menu-link text-decoration-none d-flex align-items-center">
                    <i class="menu-icon tf-icons bx bx-user-check me-2"></i>
                    <span>Penilaian Siswa</span>
                </a>
            </li>
        @endif

{{-- SISWA MENU --}}
@if (Auth::user()->role == 'siswa')
    <li class="menu-header small text-uppercase mb-2 mt-3">
        <span class="menu-header-text text-secondary">Menu Siswa</span>
    </li>
    {{-- Profil --}}
    <li class="menu-item {{ request()->routeIs('siswas.listAlternatif') ? 'active' : '' }}">
        <a href="{{ route('siswas.listAlternatif') }}" class="menu-link text-decoration-none d-flex align-items-center">
            <i class="menu-icon tf-icons bx bx-box me-2"></i>
            <span>Data Alternatif</span>
        </a>
    </li>

    <li class="menu-item {{ request()->routeIs('siswas.showKriteria') ? 'active' : '' }}">
        <a href="{{ route('siswas.showKriteria') }}" class="menu-link text-decoration-none d-flex align-items-center">
            <i class="menu-icon tf-icons bx bx-collection me-2"></i>
            <span>Kriteria dan Sub Kriteria </span>
        </a>
    </li>

    <li class="menu-item {{ request()->routeIs('siswas.lihatSiswa') ? 'active' : '' }}">
        <a href="{{ route('siswas.lihatSiswa') }}" class="menu-link text-decoration-none d-flex align-items-center">
            <i class="menu-icon tf-icons bx bx-user me-2"></i>
            <span>Daftar Siswa</span>
        </a>
    </li>
    @endif

        {{-- <li class="menu-header small text-uppercase mb-2 mt-3">
            <span class="menu-header-text text-secondary">Akun</span>
        </li>
        <li class="menu-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-link d-flex align-items-center w-100 border-0 bg-transparent p-0" style="text-align: left;">
                    <i class="menu-icon tf-icons bx bx-power-off me-2"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li> --}}
    </ul>
</aside>
