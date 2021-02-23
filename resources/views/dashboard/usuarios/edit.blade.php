@extends('admin.index')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-pill">
        <li class="breadcrumb-item"><a href="/"><i class="bx bx-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editanto Usuario {{ $user->name }}</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="content-header row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar rol usuario</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 form-group ">
                                    <label for="name">Nombre</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Nombre Completo" value="{{ old('name', $user->name) }}">
                                        <div class="form-control-position">
                                            <i class="bx bx-list-ul" id="view-icon"></i>
                                        </div>
                                    </div>
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="rol">Rol Pricipal</label>
                                    <div class="position-relative has-icon-left">
                                        <select name="rol" id="rol" class="form-control">
                                            <option value="{{ $user->roles()->first()->id }}">
                                                {{ $user->roles()->first()->name }}
                                            </option>
                                            @foreach ($roles as $item)
                                                @if ($user->roles()->first()->id != $item->id)
                                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="form-control-position">
                                            <i class="bx bx-user-circle"></i>
                                        </div>
                                    </div>
                                    @error('rol')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            

                                <div class="col-12 d-flex justify-content-end ">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
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