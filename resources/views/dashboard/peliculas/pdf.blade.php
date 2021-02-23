<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    @isset($pelicula)
    <h1>Lista peliculas</h1>

    <table>
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
        <tbody>
            @foreach ($peliculas as $pelicula)
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
                    <i class="{{ $pelicula->status == 1 ?'success':'danger'}}
                        font-small-1 mr-50">
                        {{ $pelicula->status == 1 ?'activo':'inactivo' }}
                    </i>
                </td>
                @endforeach
        </tbody>
        </tbody>
    </table>
    @endisset
    @isset($usuarios)
    <h1>Lista usuarios</h1>

    <table>
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>CORREO</th>
                <th>ESTADO</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td class="text-bold-500">
                    {{ $usuario->email}}
                </td>
                <td>&nbsp;&nbsp;
                    <i class="{{ $usuario->status == 1 ?'text-success':'text-danger'}}
                        font-small-1 mr-50">
                        {{ $usuario->status == 1 ?'activo':'inactivo' }}
                    </i>
                </td>
                
                <td>{{ $usuario->roles()->first()->name }}</td>
                @endforeach
        </tbody>
        </tbody>
    </table>
    @endisset
    @isset($historico_renta)
    <h1>Historico de renta</h1>

    <table>
        <thead>
            <tr>
                <th>PELICULA</th>
                <th>USUARIO</th>
                <th>DESCRIPCION</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            @foreach ($historico_renta as $hr)
            <tr>
                <td>{{ $hr->pelicula->nombre }}</td>
                <td class="text-bold-500">
                    {{ $hr->usuario->name}}
                </td>
                <td>{{ $hr->descripcion }}</td>
                @endforeach
        </tbody>
        </tbody>
    </table>
    @endisset
</body>

</html>