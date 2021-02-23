@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Historicos</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row" id="table-borderless">

    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <a href="{{ route('peliculas.export','historico') }}" class="btn btn-success">
                    Export Excel</a>
                <a href="{{ route('peliculas.export-pdf','historico') }}" class="btn btn-success">
                    Export PDF</a>
                <!-- table with no border -->
                <div class="table-responsive">
                    <table class="table table-borderless mb-1">
                        <thead>
                            <tr>
                                <th>PELICULA</th>
                                <th>USUARIO</th>
                                <th>DECRIPCION</th>
                                <th>FECHA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($historico_renta as $hr)
                            <tr>
                                <td>{{ $hr->pelicula->nombre }}</td>
                                <td class="text-bold-500">
                                    {{ $hr->usuario->name}}
                                </td>
                                <td>{{ $hr->descripcion }}</td>
                                <td>{{ $hr->created_at->diffForHumans() }}</td>
                            @empty
                            <h4>No hay historial registrado</h4>
                            @endforelse
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