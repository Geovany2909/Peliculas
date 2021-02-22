<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\RentaPeliculasController;
use App\Models\RentaPelicula;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fechaDev',[RentaPeliculasController::class, 'multa']);

Route::group(['prefix'=>'dashboard','middleware' => ['auth']], function(){
    Route::get('/', function () {
        $users = User::paginate(4);
        return view('dashboard.dashboard', compact('users'));
    })->middleware(['auth'])->name('dashboard');

    //rutas de peliculas
    Route::resource('peliculas', PeliculasController::class)->except(['index']);
    Route::get('/peliculas', [PeliculasController::class, 'index'])->name('peliculas.index');
    Route::get('/peliculas/{tipo}', [PeliculasController::class, 'index']);
    Route::get('/peliculas/activar/{id}', [PeliculasController::class, 'activar'])->name('peliculas.activar');
    Route::get('/peliculas/desactivar/{id}', [PeliculasController::class, 'desactivar'])->name('peliculas.desactivar');
    Route::get('/pelicula/{id}/comprar',[PeliculasController::class,'comprar'])->name('peliculas.compra');
    Route::get('/pelicula/compradas',[PeliculasController::class,'listaCompradas'])->name('peliculas.listaCompradas');
    Route::post('/peliculas/comprarStore/',[PeliculasController::class,'comprarStore'])->name('peliculas.compraStore');
    //rutas de renta de peliculas
    Route::resources([
        'renta-peliculas'=> RentaPeliculasController::class,
        'users'=> User::class,
    ]);
    Route::get('/renta-peliculas/activar/{id}', [RentaPeliculasController::class, 'activar'])->name('renta-peliculas.activar');
    Route::get('/renta-peliculas/desactivar/{id}', [RentaPeliculasController::class, 'desactivar'])->name('renta-peliculas.desactivar');
    Route::get('/renta-peliculas/regresar/{id}', [RentaPeliculasController::class, 'regresarPelicula'])->name('renta-peliculas.regresar');
    
    
});


