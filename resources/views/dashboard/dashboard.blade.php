@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-12 mb-2">
        <div class="content-body">
            <div class="row">
                <div class="col-md-4">
                    <section class="search-bar-wrapper">
                        @role('Administrador')
                        <div class="search-bar row">
                            <a href="{{ route('peliculas.export','usuarios') }}" class="btn btn-success">
                                Export Excel</a>
                            &nbsp;&nbsp;
                            <a href="{{ route('peliculas.export-pdf','usuarios') }}" class="btn btn-success">
                                Export PDF</a>
                        </div>
                        @endrole
                    </section>
                </div>
                <div class="col-md-2">
                    @can('create-users')
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-lg btn-block">Registrar</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach($users as $user)
    <div class="col-lg-6 col-xl-6 user-details-card">
        <div class="card widget-user-details">
            <div class="card-header">
                <div class="card-title-details d-flex align-items-center">
                    <div class="avatar bg-rgba-primary p-25 mr-2 ml-0">
                        <img class="img-fluid" src="/img/avatar/{{ $user->photo ? $user->photo : 'user.png' }}"
                            alt="img placeholder" height="70" width="70">
                    </div>
                    <div>
                        <h5>{{ $user->name}}</h5>
                        <div class="card-subtitle">{{ $user->roles()->first()->name }} ({{ $user->email }})</div>
                    </div>
                </div>
                @role('Administrador')
                <div class="heading-elements">
                    <div class="dropdown">
                        <span
                            class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                        <div class="dropdown-menu dropdown-menu-right" id="items">
                            {{-- verificamos que tenga el permiso de editar --}}

                            <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                <i class="bx bx-edit-alt mr-1"></i>Editar
                            </a>
                        </div>
                    </div>
                </div>
                @endrole
            </div>
            <div class="card-content">
                <div Class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="pb-0"><strong>Creado</strong></td>
                                    <td class="pb-0"><strong>Estado</strong></td>
                                </tr>
                                <tr>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <p class="{{ $user->status == 1 ? 'text-success' : 'text-danger' }}">
                                            {{ $user->status == 1 ? 'Activo' : 'Inactivo'  }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between border-top">
                <div class="d-flex">
                    <div class="d-inline-flex align-items-center mr-2">
                        <i class=' mr-25'></i>
                        <small></small>
                    </div>
                    <div class="d-inline-flex align-items-center">
                        <i class=' mr-25'></i>
                        <small></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{ $users->render() }}
</div>
@endsection

@section('css_vendor')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/swiper.min.css') }}">
@endsection

@section('css_page')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/swiper.css') }}">
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/widgets.css') }}">
@endsection

@section('js_page')
<script src="{{ mix('/js/page/swiper.min.js') }}"></script>
@endsection

@section('js_custom')
<script src="{{ mix('/js/custom/page-search.js') }}"></script>
<script src="{{ mix('/js/custom/widgets.js') }}"></script>
@endsection