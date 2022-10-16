<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme">
    <div class="app-brand demo border-b-1 mb-1">
        <a href="{{ route('client.home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img class="w-10" src="{{ asset('img/icons/logo-black.png') }}">
            </span>
            <span class="app-brand-text demo menu-text ms-2 uppercase">E-LIB</span>
        </a>

        {{-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a> --}}
    </div>

    <ul class="menu-inner py-1 ps">
        <li class="menu-item {{ Route::is('client.home') ? 'active' : '' }}">
            <a href="{{ route('client.home') }}" class="menu-link" onclick="selectMenu(0)">
                <i class="menu-icon tf-icons bx bx-home"></i>
                <div>Bosh sahifa</div>
            </a>
        </li>

        @foreach ($menus as $m)
            <li class="menu-item" data-select="menu-item-{{ $m->id }}">
                <a href="javascript:void(0)" @class(['menu-link', 'menu-toggle' => empty($m->route)]) onclick="selectMenu({{ $m->id }})">
                    <i class="menu-icon tf-icons bx {{ $m->icon }}"></i>
                    <div data-i18n="Layouts">{{ $m->name }}</div>
                </a>
                <ul class="menu-sub">
                    @foreach ($submenus as $s)
                        @if ($m->id == $s->parentId)
                            <li class="menu-item {{ Route::is($s->route) ? 'active' : '' }}">
                                <a href="{{ route($s->route) }}" class="menu-link">
                                    <div data-i18n="Without menu">{{ $s->name }}</div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach

        <!-- Open menus -->
        @foreach ($openmenus as $o)
            <li class="menu-item {{ Route::is($o->route) ? 'active' : '' }}">
                <a href="{{ route($o->route) }}" class="menu-link" onclick="selectMenu({{ $o->id }})">
                    <i class="menu-icon tf-icons bx {{ $o->icon }}"></i>
                    <div data-i18n="Layouts">{{ $o->name }}</div>
                </a>
            </li>
        @endforeach

        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Vidjetlar</span></li>
        <li class="menu-item">
            <a href="https://t.me/KUlibrarybot" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Qo'llab quvatlash</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="https://t.me/LIBRARY_KU" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Elektron kitoblar</div>
            </a>
        </li>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 881px; right: 4px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </ul>
</aside>
