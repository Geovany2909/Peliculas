<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loading" data-textdirection="ltr">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Admin de sistemas.">
    <meta name="keywords" content="admin template, dashboard template, responsive admin template, web app">
    <meta name="author" content="SIAH">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" href="/img/logo/b.png">
    <link rel="shortcut icon" type="image/x-icon" href="/img/logo/b.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/sweetalert2.min.css') }}">
    @yield('css_vendor')
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/select2.min.css') }}">
    @yield('css_theme')
    <!-- END: Theme CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/page/vertical-menu.css') }}">
    @yield('css_page')
    <!-- END: Page CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/custom/style.css') }}">
    @yield('css_custom')
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->
<body class="{{ auth()->user()->style->style }}" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    
    <script src="/acciones/msg.js"></script>
    <script src="{{ mix('/js/page/sweetalert2.all.min.js' ) }}"></script>
    <script src="{{ mix('/js/page/polyfill.min.js' ) }}"></script>

    <!-- BEGIN: alert float JS-->
    @include('admin/alert')
    <!-- END: alert float JS-->

    @section('header')
        <!-- BEGIN: Header-->
        @include('admin/navbar')
        <!-- END: Header-->
        <!-- BEGIN: Main Menu-->
        @include('admin/menu')
        <!-- END: Main Menu-->
    @show

    <!-- BEGIN: Content-->
    <div class="app-content content">
         <div class="content-wrapper">
            <div class="content-header row">
                <div class="col-md-12 mt-2">
                    @yield('breadcrumb')
                </div>
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @section('footer')
        <!-- BEGIN: Footer-->
        @include('admin/footer')
        <!-- END: Footer-->
    @show

    <!-- BEGIN: Vendor JS-->
    <script src="{{ mix('/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ mix('/js/vendor/vendors.min.js') }}"></script>
    @yield('js_vendor')
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ mix('/js/page/select2.full.min.js') }}"></script>
    @yield('js_page')
    <!-- END: Page JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ mix('/js/theme/app-menu.js') }}"></script>
    <script src="{{ mix('/js/theme/app.js') }}"></script>
    <script src="{{ mix('/js/theme/components.js') }}"></script>
    <script src="{{ mix('/js/theme/footer.js') }}"></script>
    @yield('js_theme')
    <!-- END: Theme JS-->

    <!-- BEGIN: Custom JS-->
    <script src="{{ mix('/js/custom/form-select2.js') }}"></script>
    @yield('js_custom')
    <!-- END: Custom JS-->  

</body>
</html>