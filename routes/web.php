<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\RentaPeliculasController;
use App\Http\Controllers\UsuariosController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});


Route::get('/fechaDev',[RentaPeliculasController::class, 'multa']);
Route::get('peliculas/list', [PeliculasController::class, 'getPeliculas'])->name('peliculas.list');
Route::get('/dashboard/peliculas/filtradas', [PeliculasController::class, 'index'])->name('peliculas.index');
Route::get('peliculas/{tipo}/exportCSV', [PeliculasController::class, 'exportCSV'])->name('peliculas.export');
Route::get('peliculas/{tipo}/exportPDF/', [PeliculasController::class, 'exportPDF'])->name('peliculas.export-pdf');
Route::get('historicos', [RentaPeliculasController::class, 'historico'])->name('historico');


Route::group(['prefix'=>'dashboard','middleware' => ['auth']], function(){
    Route::get('/', [UsuariosController::class,'index'])->name('dashboard');

    //rutas de peliculas
    Route::resource('peliculas', PeliculasController::class)->except(['index']);
    Route::get('/peliculas', [PeliculasController::class, 'getPeliculasFiltro'])->name('peliculas.filtro');
    Route::get('/peliculas/{tipo}', [PeliculasController::class, 'index']);
    Route::get('/peliculas/activar/{id}', [PeliculasController::class, 'activar'])->name('peliculas.activar');
    Route::get('/peliculas/desactivar/{id}', [PeliculasController::class, 'desactivar'])->name('peliculas.desactivar');
    Route::get('/pelicula/{id}/comprar',[PeliculasController::class,'comprar'])->name('peliculas.compra');
    Route::get('/pelicula/compradas',[PeliculasController::class,'listaCompradas'])->name('peliculas.listaCompradas');
    Route::post('/peliculas/comprarStore/',[PeliculasController::class,'comprarStore'])->name('peliculas.compraStore');
    //rutas de renta de peliculas
    Route::resources([
        'renta-peliculas'=> RentaPeliculasController::class,
        'users'=> UsuariosController::class,
    ]);
    Route::get('/renta-peliculas/activar/{id}', [RentaPeliculasController::class, 'activar'])->name('renta-peliculas.activar');
    Route::get('/renta-peliculas/desactivar/{id}', [RentaPeliculasController::class, 'desactivar'])->name('renta-peliculas.desactivar');
    Route::get('/renta-peliculas/regresar/{id}', [RentaPeliculasController::class, 'regresarPelicula'])->name('renta-peliculas.regresar');
});


