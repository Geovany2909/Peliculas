<?php

namespace App\Exports;

use App\Models\HistoricoRenta;
use Maatwebsite\Excel\Concerns\FromCollection;

class HistoricoRentaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HistoricoRenta::all();
    }
}
