<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatu extends Model
{
    use HasFactory;
    //Asignación masiva
    protected $fillable = [
        'nombre',
    ];
    //Relación 1 a muchos para la tabla de salas
    public function salas(){
        return $this->hasMany('App\Models\Sala');
    }
    //Relación 1 a muchos para la tabla de reservas
    public function reservas(){
        return $this->hasMany('App\Models\Reserva');
    }
}
