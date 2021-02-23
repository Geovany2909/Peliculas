<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoRenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'pelicula_id',
        'usuario_id',
        'descripciom',
    ];

    public function pelicula(){
        return $this->hasOne(Pelicula::class, 'id', 'pelicula_id');
    }
    
    public function usuario(){
        return $this->hasOne(User::class, 'id', 'usuario_id');
    }
}
