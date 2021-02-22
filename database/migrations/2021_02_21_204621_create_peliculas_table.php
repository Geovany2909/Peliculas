<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('descripcion', 500);
            $table->date('anio');
            $table->integer('existencias')->default(0);
            $table->float('precioVenta', 8,2)->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            //creando la relacion entre peliculas y categorias
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
}
