<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RentaPelicula extends Model
{
    use HasFactory;
    protected $fillable = [
        'pelicula_id',
        'usuario_id',
        'fechaRenta',
        'fechaDevolucion',
        'status',
    ];

    public function scopeOnlyUser($query){
        return $query->where('usuario_id', Auth::user()->id)->where('regresado',0);
    }

    public function pelicula(){
        return $this->hasOne(Pelicula::class, 'id', 'pelicula_id');
    }
    
    public function usuario(){
        return $this->hasOne(User::class, 'id', 'usuario_id');
    }
}
