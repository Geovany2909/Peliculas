@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Peliculas Compradas</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row" id="table-borderless">

    <div class="col-12">

        <div class="card">
            <div class="card-content">
                <!-- table with no border -->
                <div class="table-responsive">
                    <table class="table table-borderless mb-1">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>ESTRENO</th>
                                <th>CATEGORIA</th>
                                <th>DESCRIPCION</th>
                                <th>PRECIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peliculas as $pelicula)
                            <tr>
                                <td>{{ $pelicula->pelicula->nombre }}</td>
                                <td class="text-bold-500">
                                    {{ $pelicula->pelicula->anio}}
                                </td>
                                <td><a href="#">
                                        <mark>{{ $pelicula->pelicula->categoria->nombre }}</mark>
                                    </a></td>
                                <td>{{ $pelicula->pelicula->descripcion }}</td>
                                <td>${{ $pelicula->pelicula->precioVenta }}</td>
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