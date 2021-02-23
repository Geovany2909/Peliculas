@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Renta de peliculas</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row" id="table-borderless">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @if (count($peliculas)>0)
                <a href="{{ route('renta-peliculas.create') }}"
                    class="btn btn-outline-success bx bx-plus-medical">Rentar
                </a>
                @endif
            </div>
            <div class="card-content">
                <!-- table with no border -->
                <div class="table-responsive">
                    <table class="table table-borderless mb-1">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Pelicula</th>
                                <th>Fecha de renta</th>
                                <th>Fecha de devolucion</th>
                                <th>Multa</th>
                                <th>ESTADO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentas as $renta)
                            <tr>
    
                                <td><mark>{{ $renta->usuario->name }}</mark></td>
                                <td><mark>{{ $renta->pelicula->nombre }}</mark></td>
                                <td>{{ $renta->fechaRenta }}</td>
                                <td
                                    class="text-bold-500 {{ $renta->fechaDevolucion < date('Y-m-d') ? 'text-danger' :'text-success' }}">
                                    {{ $renta->fechaDevolucion}}
                                </td>
                                <td>${{ $renta->multa }}</td>
                                <td>&nbsp;&nbsp;
                                    <i class="bx bxs-circle {{ $renta->status == 1 ?'success':'danger'}}
                                        font-small-1 mr-50">
                                    </i>
                                </td>
                                @role('Administrador')
                                <td>
                                    <a href="{{ route('renta-peliculas.edit', $renta->id) }}" title="Editar">
                                        <i class="badge-circle badge-circle-light-secondary
                                            bx bx-edit-alt font-medium-4">
                                        </i>
                                    </a>
                                    <br><br>
                                    <a href="{{ $renta->status == 0 ? route('renta-peliculas.activar',$renta->id): 
                                        route('renta-peliculas.desactivar', $renta->id) }}" 
                                        title="{{ $renta->status == 0 ? 'Activar' : 'Desactivar'}}">
                                        <i class="badge-circle badge-circle-light-secondary
                                            bx bx-archive-in font-medium-4">
                                        </i>
                                    </a>
                                </td>
                                @endrole
                                @role('Cliente')
                                <td>
                                    <a href="{{ route('renta-peliculas.regresar',$renta->id) }}" title="Regresar pelicula">
                                        <i class="badge-circle badge-circle-light-secondary
                                            bx bx-reset text-info font-medium-4">
                                        </i>
                                    </a>
                                </td>
                                @endrole
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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