<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img class="w-10" src="{{ asset('img/icons/logo-black.png') }}">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Library</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 ps">
        @foreach ($menus as $m)
            <li class="menu-item {{ Route::is($m->route) ? 'active' : '' }}" @empty($m->route) data-select="menu-item-{{ $m->id }}" @endempty>
                <a href="@empty($m->route) #! @else {{ route($m->route) }} @endempty"
                    @class(['menu-link', 'menu-toggle' => empty($m->route)])
                    onclick="selectMenu({{ $m->id }})">
                    <i class="menu-icon tf-icons bx {{ $m->icon }}"></i>
                    <div data-i18n="Layouts">{{ $m->name }}</div>
                </a>
                @if (empty($m->route))
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
                @endif
            </li>
        @endforeach
        
        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Vidjetlar</span></li>
        <li class="menu-item">
            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
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
