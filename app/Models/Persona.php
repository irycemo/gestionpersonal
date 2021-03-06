<?php

namespace App\Models;

use App\Models\Falta;
use App\Models\Horario;
use App\Models\Retardo;
use App\Models\Checador;
use App\Models\Permisos;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $guarded = ['id', 'created_at','updated_at'];

    public function horario(){
        return $this->belongsTo(Horario::class);
    }

    public function incapacidades(){
        return $this->hasMany(Incapacidad::class);
    }

    public function justificaciones(){
        return $this->hasMany(Justificacion::class);
    }

    public function retardos(){
        return $this->hasMany(Retardo::class);
    }

    public function faltas(){
        return $this->hasMany(Falta::class);
    }

    public function checados(){
        return $this->hasMany(Checador::class);
    }

    public function permisos(){
        return $this->belongsToMany(Permisos::class)->withPivot(['fecha_inicio', 'fecha_final', 'tiempo_consumido'])->withTimestamps();
    }
}


