@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Mensaje Publico</li>
    </ol>
</nav>
@endsection

@section('content')


<div class="content-header row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    {!! Form::open(['url'=>['mensajePublico'], 'method'=>'get','class'=>'form repeater-default','files'=>true]) !!}
                    <div class="row justify-content-between">
                        <div class="col-md-12 col-sm-12 form-group" style="height: 25px" >
                            <label for="">Informacion</label>
                            {!! Form::text('asunto','Este mensaje será enviado a '. $numeroClientes.' Clientes Bodytek ',['class'=>'form-control','id'=>'Asunto','placeholder'=>'Asunto', 'disabled']) !!}
                        </div>
                        <div class="col-md-12 col-sm-12 form-group" style=" margin-top:35px; height: 25px" >
                            <label for="Asunto">Asunto</label>
                            {!! Form::text('asunto',null,['class'=>'form-control','id'=>'Asunto','placeholder'=>'Asunto', 'required']) !!}
                            @error('asunto')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12 col-sm-12 form-group" style="margin-top:35px; height: 100px" >
                            <label for="descripcion">Mensaje Publico</label>
                            {!! Form::textarea('descripcion',null,['class'=>'form-control','id'=>'descripcion','placeholder'=>'Contenido', 'required','style'=>'height: 100px']) !!}
                            @error('descripcion')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <hr>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col p-0">
                            <button class="btn btn-success" type="submit"><i class="bx bx-plus"></i>
                               Enviar mensaje
                            </button>
                        </div>

                    </div>
                    {!! Form::close() !!}
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
