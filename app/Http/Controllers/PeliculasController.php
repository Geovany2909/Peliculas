<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\CompraPelicula;
use App\Models\HistoricoRenta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PeliculasController extends Controller
{
    public function index(Request $request)
    {
        //el metodo active esta definido en el model de peliculas
        if ($request->orden != '') {
            $peliculas = Pelicula::where('status', $request->status)
                ->where('existencias', '>', 0)
                ->orderBy($request->orden, 'ASC')
                ->paginate(4);
        } else {
            $peliculas = Pelicula::where('existencias', '>', 0)->orderBy('nombre', 'ASC')->paginate(4);
        }

        $categorias = Categoria::all();
        return view('dashboard.peliculas.index', compact('peliculas', 'categorias'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('dashboard.peliculas.create', compact('categorias'));
    }

    public function edit(Pelicula $pelicula)
    {
        $categorias = Categoria::all();
        return view('dashboard.peliculas.edit', compact('pelicula', 'categorias'));
    }

    public function store(Request $request)
    {
        // ddd($request);
        DB::beginTransaction();
        $pelicula = new Pelicula();
        $pelicula->nombre = $request->nombre;
        $pelicula->descripcion = $request->descripcion;
        $pelicula->anio = $request->anio;
        $pelicula->precioVenta = $request->precioVenta;
        $pelicula->existencias = $request->existencias;
        $pelicula->categoria_id = $request->categoria_id;
        $pelicula->save();

        DB::commit();
        Alert::success('Creada!', 'La pelicula fue creada exitosamente');
        return redirect()->route('peliculas.index');
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->nombre = $request->nombre;
        $pelicula->descripcion = $request->descripcion;
        $pelicula->anio = $request->anio;
        $pelicula->precioVenta = $request->precioVenta;
        $pelicula->existencias = $request->existencias;
        $pelicula->categoria_id = $request->categoria_id;
        $pelicula->update();

        DB::commit();
        Alert::success('Actualizada!', 'La pelicula fue creada exitosamente');
        return redirect()->route('peliculas.index');
    }

    public function show()
    {
    }
    public function comprar($id)
    {
        $pelicula = Pelicula::find($id);
        return view('dashboard.renta_peliculas.compra', compact('pelicula'));
    }

    public function listaCompradas(){
        if(Auth::user()->hasRole('Cliente')){
            $peliculas = CompraPelicula::where('usuario_id', Auth::user()->id)->get();
        }
        return view('dashboard.peliculas.lista_compradas', compact('peliculas'));
    }

    public function comprarStore(Request $request)
    {
        DB::beginTransaction();

        $pelicula = Pelicula::find($request->pelicula_id);
        $pelicula->existencias -= 1;
        $pelicula->save();

        $compra = new CompraPelicula();
        $compra->usuario_id = $request->usuario_id;
        $compra->pelicula_id = $request->pelicula_id;
        $compra->precio = $compra->pelicula->precioVenta;
        $compra->save();

        //se crea el historico

        $historico_renta = new HistoricoRenta();
        $historico_renta->usuario_id = $request->usuario_id;
        $historico_renta->pelicula_id = $request->pelicula_id;
        $historico_renta->descripcion = "El usuario: " . $compra->usuario->name . " ha comprado la pelicula: " . $compra->pelicula->nombre;
        $historico_renta->save();

        DB::commit();
        Alert::success('Comprada!', 'La pelicula fue comprada exitosamente');
        return redirect()->route('renta-peliculas.index');
    }

    public function activar($id)
    {
        DB::beginTransaction();
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->status = 1;
        $pelicula->update();
        DB::commit();
        Alert::info('Activada!', 'La pelicula fue activada exitosamente');
        return redirect()->route('peliculas.index');
    }
    public function desactivar($id)
    {
        DB::beginTransaction();
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->status = 0;
        $pelicula->update();
        DB::commit();
        Alert::info('Desactivada!', 'La pelicula fue desactivada exitosamente');
        return redirect()->route('peliculas.index');
    }
}
