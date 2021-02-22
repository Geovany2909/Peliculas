@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('renta-peliculas.index') }}">Renta</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editando renta</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="content-header row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rentar pelicula</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{route('renta-peliculas.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="id_category">Usuario</label>
                                    <div class="position-relative has-icon-left">
                                        <select name="usuario_id" id="usuario_id" class="form-control" required>
                                            <option selected value="{{ $renta->usuario_id }}">
                                                {{ $renta->usuario->name}}
                                            </option>
                                            @foreach ($usuarios as $item)
                                            @if ($item->id != $renta->usuario_id)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <div class="form-control-position">
                                            <i class="bx bxs-categories"></i>
                                        </div>
                                    </div>
                                    @error('usuario_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="id_category">Pelicula</label>
                                    <div class="position-relative has-icon-left">
                                        <select name="pelicula_id" id="pelicula_id" class="form-control" required>
                                            <option selected value="{{ $renta->pelicula_id }}">
                                                {{ $renta->pelicula->nombre }}
                                            </option>
                                            @foreach ($peliculas as $item)
                                            @if ($item->id != $renta->pelicula_id)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <div class="form-control-position">
                                            <i class="bx bxs-categories"></i>
                                        </div>
                                    </div>
                                    @error('pelicula_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="expiredDate">Fecha de renta</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="date" name="fechaRenta"
                                            value="{{ old('fechaRenta', $renta->fechaRenta) }}" id="fechaRenta"
                                            class="form-control">
                                        <div class="form-control-position">
                                            <i class="bx bx-edit-alt"></i>
                                        </div>
                                    </div>
                                    @error('fechaRenta')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="expiredDate">Fecha de devolucion</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="date" name="fechaDevolucion"
                                            value="{{ old('fechaDevolucion', $renta->fechaDevolucion) }}"
                                            id="fechaDevolucion" class="form-control">
                                        <div class="form-control-position">
                                            <i class="bx bx-edit-alt"></i>
                                        </div>
                                    </div>
                                    @error('fechaDevolucion')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-end ">
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css_vendor')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/swiper.min.css') }}">
<link rel="stylesheet" href="{{ mix('css/vendor/jquery.bootstrap-touchspin.css') }}">
@endsection

@section('css_page')
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/search.css') }}">
<link rel="stylesheet" type="text/css" href="{{ mix('/css/page/swiper.css') }}">
@endsection

@section('js_page')
<script src="{{ mix('/js/page/swiper.min.js') }}"></script>
<script src="{{ mix('/js/page/jquery.bootstrap-touchspin.js') }}"></script>
@endsection

@section('js_custom')
<script src="{{ mix('/js/custom/page-search.js') }}"></script>
<script src="{{ mix('/js/custom/number-input.js') }}"></script>

@endsection