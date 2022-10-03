<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;
    //Asignación masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'user_id',
        'estatu_id',
    ];
    //Relación 1 a muchos invertida para la tabla de estatus
    public function estatu(){
        return $this->belongsTo('App\Models\Estatu');
    }
    //Relación 1 a muchos invertida para la tabla de usuarios
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    //Relación 1 a muchos para la tabla de reservas
    public function reservas(){
        return $this->hasMany('App\Models\Reserva');
    }
}
