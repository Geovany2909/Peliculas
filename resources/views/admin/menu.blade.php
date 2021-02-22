<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="/">
                    <div class="brand-logo"></div>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"
                        style="color: rgb(0,0,0,0.7) !important;"></i>
                    <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="bx-disc" style="color: rgba(255, 255, 255, 0.856) !important;"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="">
            <li class=" nav-item">
                <a href="#">
                    <i class="bx bx-home-circle"></i>
                    <span class="menu-title" data-i18n="Dashboard">Inicio</span>
                </a>
                <ul class="menu-content">
                    <li class="@if(Request::path() == 'home') active @endif">
                        <a href="/home">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Analytics">Panel</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="navigation-header">
                <span>Administración</span>
            </li>
            <!-- recorremos la lista de menu existente -->

            @role('Administrador')
            <li class=" nav-item">
                <a href="#">
                    <i class="bx bxs-user-badge"></i>
                    <rect class="lievo-donotdraw lievo-likestroke lievo-altstroke" x="6" y="8" opacity="0.5" fill="#8baff3ad" width="48" height="30" stroke="none" style="stroke-width: 0;"></rect>
                    <span class="menu-title" data-i18n="Dashboard">Usuarios</span>
                </a>
                <ul class="menu-content">
                    <li class="@if(Request::path() == 'dashboard') active @endif">
                        <a href="/dashboard">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Analytics">Listar</span>
                        </a>
                    </li>
                    <li class="@if(Request::path() == 'permisos') active @endif">
                        <a href="/dashboard/permisos">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Analytics">Permisos</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endrole
            <li class=" nav-item">
                <a href="#">
                    <i class="bx bxs-user-badge"></i>
                    <rect class="lievo-donotdraw lievo-likestroke lievo-altstroke" x="6" y="8" opacity="0.5" fill="#8baff3ad" width="48" height="30" stroke="none" style="stroke-width: 0;"></rect>
                    <span class="menu-title" data-i18n="Dashboard">Peliculas</span>
                </a>
                <ul class="menu-content">
                    <li class="@if(Request::path() == 'peliculas') active @endif">
                        <a href="{{ route('peliculas.filtro') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Analytics">Listar</span>
                        </a>
                    </li>
                    <li class="@if(Request::path() == 'peliculas') active @endif">
                        <a href="{{ route('peliculas.index') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Analytics">Listar por filtro</span>
                        </a>
                    </li>
                </ul>
                @role('Cliente')
                <ul class="menu-content">
                    <li class="@if(Request::path() == 'listaCompradas') active @endif">
                        <a href="{{ route('peliculas.listaCompradas') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Analytics">Listar compradas</span>
                        </a>
                    </li>
                </ul>
                @endrole
            </li>
            <li class=" nav-item">
                <a href="#">
                    <i class="bx bxs-user-badge"></i>
                    <rect class="lievo-donotdraw lievo-likestroke lievo-altstroke" x="6" y="8" opacity="0.5" fill="#8baff3ad" width="48" height="30" stroke="none" style="stroke-width: 0;"></rect>
                    <span class="menu-title" data-i18n="Dashboard">Rentar Peliculas</span>
                </a>
                <ul class="menu-content">
                    <li class="@if(Request::path() == 'renta-peliculas') active @endif">
                        <a href="{{ route('renta-peliculas.index') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="Analytics">Listar</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</div>
