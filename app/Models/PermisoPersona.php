<?php

namespace App\Models;

use App\Models\Persona;
use App\Models\Permisos;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermisoPersona extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $table = 'permisos_persona';

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function permiso(){
        return $this->belongsTo(Permisos::class, 'permisos_id');
    }
}
