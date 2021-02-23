<?php

namespace App\Http\Controllers;

use App\Exports\HistoricoRentaExport;
use DataTables;
use App\Models\Pelicula;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\CompraPelicula;
use App\Models\HistoricoRenta;
use App\Exports\PeliculasExport;
use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class PeliculasController extends Controller
{
    public function __construct()
    {   
        $this->middleware('verified');
    }
    public function index(Request $request)
    {
        //se filtra por el orden de las peliculas
        if ($request->orden != '') {
            $peliculas = Pelicula::where('status', $request->status)
                ->where('existencias', '>', 0)
                ->orderBy($request->orden, 'ASC')
                ->paginate(4);
        } else {
            $peliculas = Pelicula::where('existencias', '>', 0)->orderBy('nombre', 'ASC')->paginate(4);
        }

        return view('dashboard.peliculas.filtro', compact('peliculas'));
    }

    public function getPeliculasFiltro()
    {
        return view('dashboard.peliculas.index');
    }
    public function getPeliculas(Request $request)
    {
        //se llena el datatable con esta funcion.
        //se ocupa el paquete Datatables para mandar una respuesta JSON
        if ($request->ajax()) {
            $model = Pelicula::with('categoria')->where('status', 1);
            return Datatables::eloquent($model)
                ->addColumn('categoria', function (Pelicula $p) {
                    return $p->categoria->nombre;
                })
                ->addColumn('status', function (Pelicula $p) {
                    return $p->status == 1 ? ' <i class="bx bxs-circle text-success font-small-1 mr-50"></i>' : ' <i class="bx bxs-circle text-danger font-small-1 mr-50"></i>';
                })
                ->rawColumns(['status'])
                ->make(true);
        }
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
        //se registra un nueva pelicula
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
    /*funcion que sirve para que el cliente pueda comprar una pelicula*/
    public function comprar($id)
    {
        $pelicula = Pelicula::find($id);
        return view('dashboard.renta_peliculas.compra', compact('pelicula'));
    }

    public function listaCompradas()
    {
        if (Auth::user()->hasRole('Cliente')) {
            $peliculas = CompraPelicula::where('usuario_id', Auth::user()->id)->get();
        }
        return view('dashboard.peliculas.lista_compradas', compact('peliculas'));
    }

    public function comprarStore(Request $request)
    {
        //funcion que sirve para que un cliente compre la pelicula deseada
        DB::beginTransaction();

        $pelicula = Pelicula::find($request->pelicula_id);
        $pelicula->existencias -= 1;
        $pelicula->save();

        $compra = new CompraPelicula();
        $compra->usuario_id = $request->usuario_id;
        $compra->pelicula_id = $request->pelicula_id;
        $compra->precio = $compra->pelicula->precioVenta;
        $compra->save();

        //se crea el historico, vease en el menu historicos
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
        //sirve para cambiar el estado de la pelicula a true = 1 
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
         //sirve para cambiar el estado de la pelicula a false = 0
        DB::beginTransaction();
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->status = 0;
        $pelicula->update();
        DB::commit();
        Alert::info('Desactivada!', 'La pelicula fue desactivada exitosamente');
        return redirect()->route('peliculas.index');
    }

    public function destroy($id){
        //se elimina permanentemente una pelicula
        DB::beginTransaction();
        $pelicula = Pelicula::findOrFail($id);
        $pelicula->delete();
        DB::commit();
        Alert::warning('Borrada!', 'la pelicula fue borrada exitosamente');
        return redirect()->back();
    }

    /**Funcion que sirve para exportar en formato excel, 
     * se ocupa la misma ruta, la ruta le injecta el paramentro del "tipo" que 
     * significa la tabla que exportara, se hace uso del paquete laravel/excel
     */
    public function exportCSV($tipo = null)
    {
        switch ($tipo) {
            case 'peliculas':
                return Excel::download(new PeliculasExport, 'peliculas.xlsx');
                break;
            case 'usuarios':
                return Excel::download(new UsersExport, 'usuarios.xlsx');
                break;
            case 'historico':
                return Excel::download(new HistoricoRentaExport, 'historico_renta.xlsx');
                break;
        }
    }

    /**Se hace uso del paquete dompdf */
    public function exportPDF($tipo)
    {
        //el scope OrderCategoria se encuentra en el modelo
        $peliculas = Pelicula::OrderCategoria()->get();
        //sirve para que en el archivo pdf solo aparezcan usuarios cliente
        $usuarios = User::role('Cliente')->get();
        $historico_renta = HistoricoRenta::all();

        switch ($tipo) {
            case 'peliculas':
                $pdf = PDF::loadView('dashboard.peliculas.pdf', compact('peliculas'))
                            ->setOptions(['defaultFont' => 'sans-serif']);
                return $pdf->download('peliculas.pdf');
                break;
            case 'usuarios':
                $pdf = PDF::loadView('dashboard.peliculas.pdf', compact('usuarios'))
                            ->setOptions(['defaultFont' => 'sans-serif']);
                return $pdf->download('usuarios.pdf');
                break;
            case 'historico':
                $pdf = PDF::loadView('dashboard.peliculas.pdf', compact('historico_renta'))
                            ->setOptions(['defaultFont' => 'sans-serif']);
                return $pdf->download('historico_renta.pdf');
                break;
        }
    }
}
