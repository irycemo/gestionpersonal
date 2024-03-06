<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Persona;
use App\Models\Permisos;
use OwenIt\Auditing\Contracts\Auditable;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermisoPersona extends Model implements Auditable
{
    use HasFactory;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    /* Status ? 1 contabilizado : no contabilizado */

    protected $fillable = ['persona_id', 'permisos_id', 'creado_por', 'fecha_inicio', 'fecha_final', 'tiempo_consumido', 'status'];

    protected $table = 'permisos_persona';

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function permiso(){
        return $this->belongsTo(Permisos::class, 'permisos_id');
    }

    public function getFechaInicioAttribute(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['fecha_inicio'])->format('d-m-Y');
    }

    public function getFechaFinalAttribute(){

        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['fecha_final'])->format('d-m-Y');

    }
}
