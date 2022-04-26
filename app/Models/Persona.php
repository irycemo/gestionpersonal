<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    public function horario(){
        return $this->hasOne(Horario::class);
    }

    public function inasistencias(){
        return $this->hasMany(Inasistencia::class);
    }

    public function incapacidades(){
        return $this->hasMany(Incapacidad::class);
    }

    public function justificaciones(){
        return $this->hasMany(Justificacion::class);
     }
}


