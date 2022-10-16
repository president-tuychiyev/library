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
                <i class="bx bx-search fs-4 lh-0"></i>
                @yield('search')
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- Language -->
            {{-- <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fi fi-{{ app()->getLocale() }} fis rounded-circle me-1 fs-3"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach (config('app.locales') as $key => $val)
                        @if ($key != app()->getLocale())
                            @php
                                $url = explode('/', url()->current());
                                $url[3] = $key;
                                $path = implode('\\', $url);
                            @endphp
                            <li>
                                <a class="dropdown-item d-flex flex-row align-items-center" href="{{ $path }}"
                                    data-language="{{ $key }}">
                                    <i class="fi fi-{{ $key }} fis rounded-circle fs-4 me-1"></i>
                                    <span class="align-middle">{{ $val }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li> --}}
            <!--/ Language -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('img/icons/logo-black.png') }}" alt=""
                            class="w-px-40 h-auto rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ session()->get('admin')->name }}</span>
                                    <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0 text-muted">
                                        <span class="badge badge-dot bg-info me-1"></span>
                                        {{ session()->get('admin')->role->nameuz }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0)"
                            onclick="infoUser({{ session()->get('admin')->id }})" data-bs-toggle="modal"
                            data-bs-target="#infoModal">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Profil</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#profilSettingModal" onclick="updateProfile(this)"
                            data-title="Profil sozlamalarini yangilash" data-id="{{ session()->get('admin')->id }}"
                            data-name="{{ session()->get('admin')->name }}"
                            data-phone="{{ session()->get('admin')->phone }}"
                            data-email="{{ session()->get('admin')->email }}">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Sozlamalar</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('auth.logout') }}">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Chiqish</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>

    </div>
</nav>
