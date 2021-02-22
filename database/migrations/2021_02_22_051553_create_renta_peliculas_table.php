<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentaPeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renta_peliculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelicula_id');
            $table->unsignedBigInteger('usuario_id');
            $table->date('fechaRenta');
            $table->date('fechaDevolucion');
            $table->float('multa',8,2)->default(0);
            $table->boolean('regresado')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('pelicula_id')->references('id')->on('peliculas');
            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renta_peliculas');
    }
}
