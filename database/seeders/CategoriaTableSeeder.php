<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::updateOrCreate([
            'nombre' => 'Acción',
        ]);
        Categoria::updateOrCreate([
            'nombre' => 'Aventuras',
        ]);
        Categoria::updateOrCreate([
            'nombre' => 'Comedias',
        ]);
        Categoria::updateOrCreate([
            'nombre' => 'Dramáticas',
        ]);
        Categoria::updateOrCreate([
            'nombre' => 'Terror',
        ]);
        Categoria::updateOrCreate([
            'nombre' => 'Musicales',
        ]);

        Categoria::updateOrCreate([
            'nombre' => 'Ciencia ficción',
        ]);

        Categoria::updateOrCreate([
            'nombre' => 'Guerra o bélicas',
        ]);
    }
}
