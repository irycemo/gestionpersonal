<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Horario;
use App\Models\Retardo;
use App\Models\Checador;
use App\Models\Permisos;
use App\Models\PermisoPersona;
use App\Http\Traits\ModelosTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Model implements Auditable
{
    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

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

    public function permisos2(){
        return $this->hasMany(PermisoPersona::class);
    }

    public function tiempoConsumidoPermisos(){

        return $this->permisos()->whereMonth('permisos_persona.created_at', Carbon::now()->month)->sum('tiempo_consumido');

    }

    public function permisosEconomicos(){

        return $this->permisos()->whereYear('permisos_persona.created_at', Carbon::now()->year)->where('descripcion','PERMISO ECONÓMICO')->count();
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


