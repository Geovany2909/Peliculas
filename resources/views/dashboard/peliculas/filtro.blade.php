@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Peliculas</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row" id="table-borderless">

    <div class="col-12">

        <div class="card">
            <div class="card-header">
                @can('create-peliculas')
                <a href="{{ route('peliculas.create') }}" class="btn btn-outline-success bx bx-plus-medical">AGREGAR
                </a>
                @endcan
            </div>


            <div class="card-content">
                @if (count($peliculas)>0)
                <form action="{{ route('peliculas.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="position-relative has-icon-left">
                                <select name="orden" id="orden" class="form-control" >
                                    <option value="">Ordenar Por</option>
                                    <option value="nombre">NOMBRE</option>
                                    <option value="anio">AÑO</option>
                                    <option value="categoria_id">CATEGORIA</option>
                                </select>
                                <div class="form-control-position">
                                    <i class="bx bxs-categories"></i>
                                </div>
                            </div>
                            <br>
                        </div>
                        @if(Auth::user()->hasRole('Administrador'))
                        <div class="col-md-4">
                            <div class="position-relative has-icon-left">
                                <select name="status" id="orden" class="form-control">
                                    <option value="todas" selected>TODAS</option>
                                    <option value="1">ACTIVA</option>
                                    <option value="0">INACTIVA</option>
                                </select>
                                <div class="form-control-position">
                                    <i class="bx bxs-categories"></i>
                                </div>
                            </div>
                            <br>
                        </div>
                        @endif
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>

                </form>
                @endif
                
                <!-- table with no border -->
                <div class="table-responsive">
                    <table class="table table-borderless mb-1">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>ESTRENO</th>
                                <th>CATEGORIA</th>
                                <th>DESCRIPCION</th>
                                <th>EXISTENCIAS</th>
                                <th>PRECIO</th>
                                <th>ESTADO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peliculas as $pelicula)
                            <tr>
                                <td>{{ $pelicula->nombre }}</td>
                                <td class="text-bold-500">
                                    {{ $pelicula->anio}}
                                </td>
                                <td><a href="#">
                                        <mark>{{ $pelicula->categoria->nombre }}</mark>
                                    </a></td>
                                <td>{{ $pelicula->descripcion }}</td>
                                <td>{{ $pelicula->existencias }}</td>
                                <td>${{ $pelicula->precioVenta }}</td>
                                <td>&nbsp;&nbsp;
                                    <i class="bx bxs-circle {{ $pelicula->status == 1 ?'success':'danger'}}
                                        font-small-1 mr-50">
                                    </i>
                                </td>
                                @if(Auth::user()->hasRole('Administrador'))
                                <td>
                                    <a href="{{ route('peliculas.edit', $pelicula->id) }}" title="Editar">
                                        <i class="badge-circle badge-circle-light-secondary
                                            bx bx-edit-alt text-info font-medium-4">
                                        </i>
                                    </a>
                                    <a href="{{ $pelicula->status == 0 ? route('peliculas.activar',$pelicula->id): 
                                        route('peliculas.desactivar', $pelicula->id) }}" 
                                        title="{{ $pelicula->status == 0 ? 'Activar' : 'Desactivar'}}">
                                        <i class="badge-circle badge-circle-light-secondary
                                            bx bx-archive-in {{ $pelicula->status == 0 ? 'text-success' : 'text-info'}}
                                            font-medium-4">
                                        </i>
                                    </a>
                                    <a href="{{ route('peliculas.destroy',$pelicula->id)}}" title"Eliminar"
                                        onclick="event.preventDefault();
                                            document.getElementById('delete-pe').submit();"">
                                        <i class="badge-circle badge-circle-light-secondary
                                            bx bx-trash-alt text-danger font-medium-4">
                                        </i>
                                    </a>
                                    <form id="delete-pe" method="POST" action="{{ route('peliculas.destroy',$pelicula->id) }}"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                @endif
                                @if(Auth::user()->hasRole('Cliente'))
                                <td>
                                    <a href="{{ route('renta-peliculas.create') }}" title="Rentar">
                                        <i class="badge-circle badge-circle-light-secondary
                                            bx bxs-basket text-success font-medium-4">
                                        </i>
                                    </a>
                                    <br><br>
                                    <a href="{{ route('peliculas.compra', $pelicula->id) }}" 
                                        title="Comprar Pelicula">
                                        <i class="badge-circle badge-circle-light-secondary
                                        bx bxs-shopping-bag text-warning font-medium-4">
                                        </i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @empty
                                <h4>No hay peliculas disponibles</h4>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{ $peliculas->links() }}

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
<script>
    // var select = document.getElementById('orden');
    // select.addEventListener('change',function(){
    //     var selectedOption = this.options[select.selectedIndex];
    //     let tipo = selectedOption.value;
    //     console.log(selectedOption.value + ': ' + selectedOption.text);
    //     window.location.href = `/dashboard/peliculas/${tipo}`;
    // });
</script>
@endsection