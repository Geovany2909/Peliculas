<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'anio',
        'categoria_id',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function categoria(){
        return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    }
}
