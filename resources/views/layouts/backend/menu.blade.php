<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        {{-- logo aplikasi --}}
        <a href="{{ url('/home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">

                <img src="{{ asset('img/koni_papsel.png') }}" alt="Logo" class="img-fluid"
                    style="width: auto; height: 60px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform:none !important;">
                {{-- Uncomment the line below to display the app name --}}
                {{-- {{ env('APP_NAME') ?? 'Laravel' }} --}}
                KONI<br> PapSel
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ env('APP_NAME') ?? 'Laravel' }}</span>
        </li>
        <li class="menu-item {{ request()->is('home*') ? 'active' : '' }}">
            <a href="{{ url('/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @if (Auth::user()->role == 'Admin')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Master Data</span>
            </li>
            <li class="menu-item {{ request()->is('kabupaten') ? 'active' : '' }}">
                <a href="{{ url('/kabupaten') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-folder"></i>
                    <div data-i18n="Analytics">Kabupaten</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('cabor') ? 'active' : '' }}">
                <a href="{{ url('/cabor') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-folder"></i>
                    <div data-i18n="Analytics">Cabor</div>
                </a>
            </li>
        @endif
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengajuan</span>
        </li>
        <li class="menu-item {{ request()->is('atlet*') ? 'active' : '' }}">
            <a href="{{ url('/atlet') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Analytics">Pengajuan Atlet</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Laporan</span>
        </li>
        <li class="menu-item {{ request()->is('laporan-atlet') ? 'active' : '' }}">
            <a href="{{ url('/laporan-atlet') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Analytics">Atlet</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('laporan-pelatih') ? 'active' : '' }}">
            <a href="{{ url('/laporan-pelatih') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Analytics">Pelatih</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Akun</span>
        </li>
        <li class="menu-item {{ request()->is('profile') ? 'active' : '' }}">
            <a href="{{ url('/profile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Profile</div>
            </a>
        </li>

    </ul>
</aside>
