<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                {{-- <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none"
                    placeholder="Search{{ asset('backend_theme/') }}."
                    aria-label="Search{{ asset('backend_theme/') }}." /> --}}
                <a href="{{ url('/') }}" class="btn btn-outline-primary">Homepage</a>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <span class="position-relative">
                        <i class="icon-base bx bx-bell icon-md"></i>
                        <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-0" style="min-width: 25rem;">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="mb-0 me-auto">Notifikasi</h6>
                            @php
                                $notifikasiCount = App\Models\Notifikasi::where('id_user', Auth::id())
                                    ->where('dibaca', false)
                                    ->count();
                            @endphp
                            @if ($notifikasiCount > 0)
                                <div class="d-flex align-items-center h6 mb-0">
                                    <span class="badge bg-label-primary me-2">{{ $notifikasiCount }} Baru</span>
                                    <a href="javascript:void(0)" class="dropdown-notifications-all p-2"
                                        data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark all as read"
                                        data-bs-original-title="Mark all as read"><i
                                            class="icon-base bx bx-envelope-open text-heading"></i></a>
                                </div>
                            @endif
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container ps">
                        <ul class="list-group list-group-flush">
                            @foreach (App\Models\Notifikasi::where('id_user', Auth::id())->where('dibaca', false)->limit(5)->get() as $notifikasi)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar">
                                                <i class="bx bx-bell icon-md text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="mb-1 d-block text-body">{{ $notifikasi->isi }}</small>
                                            <small
                                                class="text-body-secondary">{{ $notifikasi->created_at->diffForHumans() }}</small>
                                        </div>

                                    </div>
                                </li>
                            @endforeach
                            @if ($notifikasiCount <= 0)
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">

                                        <div class="flex-grow-1">
                                            <small class="mb-1 d-block text-body">Tidak ada notifikasi</small>

                                        </div>

                                    </div>
                                </li>
                            @endif
                        </ul>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                        </div>
                    </li>

                </ul>
            </li>
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (Auth::user()->avatar == null || Auth::user()->name == '')
                            <span
                                class="avatar-initial rounded-circle bg-label-primary">{{ substr(Auth::user()->name, 0, 2) }}</span>
                        @else
                            <img src="{{ Auth::user()->avatar != null || Auth::user()->avatar != '' ? url(Storage::url(Auth::user()->avatar)) : asset('/img/user.png') }}"
                                alt class="w-px-40 h-40 rounded-circle" style="object-fit: cover;" />
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        @if (Auth::user()->name == null || Auth::user()->name == '')
                                            <span
                                                class="avatar-initial rounded-circle bg-label-primary">{{ substr(Auth::user()->name, 0, 2) }}
                                            </span>
                                        @else
                                            <img src="{{ Auth::user()->avatar != null || Auth::user()->avatar != '' ? url(Storage::url(Auth::user()->avatar)) : asset('/img/user.png') }}"
                                                alt class="w-px-40 h-40 rounded-circle" style="object-fit: cover;" />
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">{{ Auth::user()->role ?? 'role' }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2 text-danger"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
