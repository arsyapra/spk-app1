<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme shadow-sm"
    id="layout-navbar"
>
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center w-100" id="navbar-collapse">
        {{-- Judul Aplikasi atau Salam --}}
        <div class="flex-grow-1 fw-bold fs-5 text-secondary ps-2">
        </div>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            {{-- PROFILE DROPDOWN --}}
            <li class="nav-item navbar-dropdown dropdown-user dropdown me-3">
                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/wakosong.JPG') }}" alt="User" class="w-px-40 h-auto rounded-circle" />
                    </div>
                    <span class="ms-2 fw-semibold d-none d-lg-inline">
                        {{ Auth::user()->name ?? 'Pengguna' }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-2">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-2">
                                    <img src="{{ asset('assets/img/wakosong.JPG') }}" alt="User" class="w-px-40 h-auto rounded-circle" />
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ Auth::user()->name ?? '-' }}</div>
                                    <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"
                                onclick="return confirm('Yakin ingin logout?')">
                                <i class="bx bx-power-off me-2"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
