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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Todas las peliculas</h4>
                </div>
                <div class="card-content">
                    @role('Administrador')
                    <a href="{{ route('peliculas.export','peliculas') }}" class="btn btn-success">
                        Export Excel</a>
                    <a href="{{ route('peliculas.export-pdf','peliculas') }}" class="btn btn-success">
                        Export PDF</a>
                    @endrole
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="datatableP">
                                <thead>
                                    <tr>
                                        <th>NOMBRE</th>
                                        <th>ESTRENO</th>
                                        <th>CATEGORIA</th>
                                        <th>DESCRIPCION</th>
                                        <th>EXISTENCIAS</th>
                                        <th>PRECIO</th>
                                        <th>ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->
<!-- END: Content-->


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
<script type="text/javascript">
    $(function () {
        
        var table = $('#datatableP').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('peliculas.list') }}",
            columns: [
                {data: 'nombre', name: 'nombre'},
                {data: 'anio', name: 'anio'},
                {data: 'categoria', name: 'categoria_id'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'existencias', name: 'existencias'},
                {data: 'precioVenta', name: 'precioVenta'},
                {data: 'status', name: 'status'},
            ]
        });  
    });
</script>
@endsection