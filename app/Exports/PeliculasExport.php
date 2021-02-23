<?php

namespace App\Exports;

use App\Models\Pelicula;
use Maatwebsite\Excel\Concerns\FromCollection;

class PeliculasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pelicula::OrderCategoria()->get();
    }
  
}
