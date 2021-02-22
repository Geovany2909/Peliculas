@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('peliculas.index') }}">Peliculas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Creando Pelicula</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="content-header row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Crear Pelicula</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{route('peliculas.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 form-group ">
                                    <label for="name">Nombre</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" name="nombre" class="form-control" id="name"
                                            placeholder="Nombre de la pelicula" value="{{ old('name') }}">
                                        <div class="form-control-position">
                                            <i class="bx bx-notepad" id="view-icon"></i>
                                        </div>
                                    </div>
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="id_category">Categoria</label>
                                    <div class="position-relative has-icon-left">
                                        <select name="categoria_id" id="categoria_id" class="form-control" required>
                                            <option value="">Seleccione una categoria</option>
                                            @foreach ($categorias as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-control-position">
                                            <i class="bx bxs-categories"></i>
                                        </div>
                                    </div>
                                    @error('categoria_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                
                                <div class="col-md-4 form-group">
                                    <label for="salesPrice">Precio venta</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="number" name="precioVenta" id="precioVenta"
                                            class="touchspin form-control" placeholder="Precio Venta" min="0"
                                            step="0.01">
                                        <div class="form-control-position">
                                            <i class="bx bx-edit-alt"></i>
                                        </div>
                                    </div>
                                    @error('precioVenta')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="stocks">Existencias</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="number" name="existencias" id="existencias" class=" form-control"
                                            placeholder="Existencias" value="0" min="1" step="1">
                                        <div class="form-control-position">
                                            <i class="bx bx-edit-alt"></i>
                                        </div>
                                    </div>
                                    @error('existencias')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="expiredDate">Fecha de estreno</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="date" name="anio"
                                        value="{{ old('anio', date('Y-m-d', strtotime('-1 week'))) }}"
                                            id="anio" class="form-control">
                                        <div class="form-control-position">
                                            <i class="bx bx-edit-alt"></i>
                                        </div>
                                    </div>
                                    @error('anio')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 form-group ">
                                    <label for="name">Descripcion</label>
                                    <div class="position-relative has-icon-left">
                                        <textarea class="form-control" name="descripcion" id="label-textarea" rows="3"
                                            placeholder="Descripción">{{ old('descripcion') }}</textarea>
                                        <div class="form-control-position">
                                            <i class="bx bx-notepad" id="view-icon"></i>
                                        </div>
                                    </div>
                                    @error('descripcion')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-end ">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
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
<script src="/acciones/producto.js"></script>
<script>
    $("input[name='existencias']").TouchSpin({
        min: 1,
        max: 100000,
        step: 1,
        decimals: 0,
        boostat: 5,
        maxboostedstep: 10,
    });
</script>

@endsection
