<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="/">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0" style="color: rgb({{auth()->user()->style_menu->style}}) !important;">{{ config('app.name', 'Laravel') }}</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon" style="color: rgb({{auth()->user()->style_menu->style}}) !important;"></i>
                        <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="bx-disc" style="color: rgb({{auth()->user()->style_menu->style}}) !important;"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="">
                <li class=" nav-item">
                    <a href="#">
                        <i class="bx bx-home-alt" style="color: rgb({{auth()->user()->style_menu->style}}) !important;"></i>
                        <span class="menu-title" data-i18n="Dashboard" style="color: rgb({{auth()->user()->style_menu->style}}) !important;">Dashboard</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@if(Request::path() == 'home') active @endif">    
                            <a href="/modulo.create">
                                <i class="bx bx-right-arrow-alt"></i>
                                <span class="menu-item" data-i18n="Analytics">Analiticas</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header">
                    <span>Administración</span>
                </li>
                <!-- recorremos la lista de menu existente -->
                <?php  
                    $ruta = explode("/", Request::path());
                    $path = $ruta[0];
                ?>
                @foreach(lista_menu() as $menu)
                    <!-- recorremos la lista de menu asignados a el usuario -->
                    @foreach(auth()->user()->user_menu() as $user_menu)
                        <!-- comparamos si el menu existente esta asignado al usuario -->
                        <!-- Si esta asignado lo deja pasar para mostrar la lista de submenu -->
                        @if($menu->id == $user_menu->id_menu)
                        <li class=" nav-item has-sub">
                            <a href="#">
                                <i class="{{ $menu->icon }}" style="color: rgb({{auth()->user()->style_menu->style}}) !important;"></i>
                                <span class="menu-title" data-i18n="Content" style="color: rgb({{auth()->user()->style_menu->style}}) !important;">{{ $menu->title }} </span>
                            </a>
                            <ul class="menu-content">
                                <!-- recorremos los submenu dependiendo del menu con el cual accedimos -->
                                @foreach(auth()->user()->accesosMenu() as $acceso)
                                @if($acceso->id_menu == $menu->id)
                                    <li class="@if($path == $acceso->url || $ruta == $acceso->url) active @endif" @if($path == $acceso->url) style="background: rgba({{auth()->user()->style_menu->style}}, 0.2); border-color: rgb({{auth()->user()->style_menu->style}});" @endif>
                                        <a href="/{{ $acceso->url }}" @if($path == $acceso->url) style="color: rgb({{auth()->user()->style_menu->style}});" @endif>
                                            <i class="{{ $acceso->icon }}" @if($path == $acceso->url) style="color: rgb({{auth()->user()->style_menu->style}});" @endif></i>
                                            <span class="menu-item" data-i18n="Grid" @if($path == $acceso->url) style="color: rgb({{auth()->user()->style_menu->style}}) !important;" @endif>{{ $acceso->title }}</span>
                                        </a>
                                    </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            @endforeach
        </ul>
    </div>
</div>