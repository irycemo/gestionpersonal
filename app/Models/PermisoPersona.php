<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Persona;
use App\Models\Permisos;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermisoPersona extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = 'permisos_persona';

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function permiso(){
        return $this->belongsTo(Permisos::class, 'permisos_id');
    }

    public function getFechaInicioAttribute(){
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_inicio'])->format('d-m-Y');
    }

    public function getFechaFinalAttribute(){
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_final'])->format('d-m-Y');
    }
}
