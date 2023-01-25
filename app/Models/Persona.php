<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Horario;
use App\Models\Retardo;
use App\Models\Checador;
use App\Models\Permisos;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

    public function imagenUrl(){

        return $this->foto
                    ? Storage::disk('personal')->url($this->foto)
                    : Storage::disk('public')->url('img/unknown_user.png');

    }

    public function getFechaIngresoAttribute(){
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_ingreso'])->format('d-m-Y');
    }
}


