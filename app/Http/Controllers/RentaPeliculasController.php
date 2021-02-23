<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Categoria;
use App\Models\HistoricoRenta;
use App\Models\RentaPelicula;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RentaPeliculasController extends Controller
{
    public function __construct()
    {   
        $this->middleware('verified');
    }
    public function index()
    {
        $peliculas = Pelicula::where('existencias', '>', 0)->get();
        $categorias = Categoria::all();

        //condicional que evalua que si el usuario es admin devuelva 
        //todas las rentas y si es cliente entonces solo aparacen renta a su nomnre
        if (Auth::user()->hasRole('Administrador')) {
            $rentas = RentaPelicula::where('regresado', 0)->get();
        } else {
            $rentas = RentaPelicula::onlyUser()->get();
        }
        return view('dashboard.renta_peliculas.index', compact('peliculas', 'categorias', 'rentas'));
    }

    public function create()
    {
        
        $peliculas = Pelicula::all();
        if (Auth::user()->hasRole('Administrador')) {
            //solo muestra clientes
            $usuarios = User::role('Cliente')->get();
        } else {
            $usuarios = User::find(Auth::user()->id);
        }

        return view('dashboard.renta_peliculas.create', compact('peliculas', 'usuarios'));
    }

    public function edit($id)
    {
        $renta = RentaPelicula::find($id);
        $peliculas = Pelicula::all();
        if (Auth::user()->hasRole('Administrador')) {
            $usuarios = User::role('Cliente')->get();
        } else {
            $usuarios = User::find(Auth::user()->id);
        }
        return view('dashboard.renta_peliculas.edit', compact('peliculas','usuarios', 'renta'));
    }

    public function store(Request $request)
    {
        //funcion que sirve para guardar una renta de pelicula
        DB::beginTransaction();
        $renta = new RentaPelicula();
        $renta->usuario_id = $request->usuario_id;
        $renta->pelicula_id = $request->pelicula_id;
        $renta->fechaRenta = $request->fechaRenta;
        $renta->fechaDevolucion = $request->fechaDevolucion;
        $renta->save();

        //se actualizan las existencias de las peliculas
        $pelicula = Pelicula::find($request->pelicula_id);
        $pelicula->existencias -= 1;
        $pelicula->save();

        //se crea el historico

        $historico_renta = new HistoricoRenta();
        $historico_renta->usuario_id = $request->usuario_id;
        $historico_renta->pelicula_id = $request->pelicula_id;
        $historico_renta->descripcion = "Se le ha rentado la pelicula: " . $renta->pelicula->nombre . " a el usuario: " . $renta->usuario->name;
        $historico_renta->save();

        DB::commit();
        Alert::success('Rentada!', 'La pelicula fue rentada exitosamente');
        return redirect()->route('renta-peliculas.index');
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $renta = RentaPelicula::find($id);
        $renta->usuario_id = $request->usuario_id;
        $renta->pelicula_id = $request->pelicula_id;
        $renta->fechaRenta = $request->fechaRenta;
        $renta->fechaDevolucion = $request->fechaDevolucion;
        $renta->save();

        //se crea el historico

        $historico_renta = new HistoricoRenta();
        $historico_renta->usuario_id = $request->usuario_id;
        $historico_renta->pelicula_id = $request->pelicula_id;
        $historico_renta->descripcion = "Se ha actualizado la informacion de la pelicula rentada: ". $renta->pelicula->nombre;
        $historico_renta->save();

        DB::commit();
        Alert::success('Actualizada!', 'La  renta fue actualizada exitosamente');
        return redirect()->route('renta-peliculas.index');
    }

    public function show()
    {
    }

    public function activar($id)
    {
        //sirve para cambiar el estado de la pelicula a true = 1 

        DB::beginTransaction();
        $renta = RentaPelicula::findOrFail($id);
        // ddd($renta);
        $renta->status = 1;
        $renta->update();
        DB::commit();
        Alert::info('Activada!', 'La renta fue activada exitosamente');
        return redirect()->route('renta-peliculas.index');
    }
    public function desactivar($id)
    {
        //sirve para cambiar el estado de la pelicula a false = 0
        DB::beginTransaction();

        $renta = RentaPelicula::findOrFail($id);
        $renta->status = 0;
        $renta->update();
        DB::commit();
        Alert::info('Desactivada!', 'La renta fue desactivada exitosamente');
        return redirect()->route('renta-peliculas.index');
    }

    /**funcion que le asigna una multa a el cliente 
     * si se pasa de la fecha de devolucion
     * con ajax se manda a llamar esta funcion, asi lo cambios se vean rapido en el frontend
     */
    public function multa()
    {
        $fechaHoy = date('Y-m-d', strtotime(now()));
        $rentas = RentaPelicula::where('fechaDevolucion', '<', $fechaHoy)->get();

        if (count($rentas) > 0) {
            foreach ($rentas as $renta) {
                echo 'entre <br>';
                $renta->multa = 5.50;
                $renta->status = 0;
                $renta->update();
                echo 'cambie';
            }
        } else {
            echo 'no hay nada';
        }
    }

    /**Sirve para que el usuario regrese la pelicula
     * se hace un historial de el suceso
     */
    public function regresarPelicula($id){
        DB::beginTransaction();
        $renta = RentaPelicula::find($id);
        $renta->regresado = 1;
        $renta->update();

        $pelicula = Pelicula::find($renta->pelicula_id);
        $pelicula->existencias += 1;
        $pelicula->update();

        $historico_renta = new HistoricoRenta();
        $historico_renta->usuario_id = $renta->usuario_id;
        $historico_renta->pelicula_id = $renta->pelicula_id;
        $historico_renta->descripcion = "La pelicula : ". $renta->pelicula->nombre . " ha sido devuelta por el usuario ". $renta->usuario->name;
        $historico_renta->save();

        DB::commit();
        Alert::info('Devuelta!', 'La pelicula fue devuelta');
        return redirect()->route('renta-peliculas.index');
    }

    //funcion que muestra los historicos, se puede ver en el menu historicos
    public function historico(){
        $historico_renta = HistoricoRenta::all();
        return view('dashboard.renta_peliculas.historico', compact('historico_renta'));
    }
}
