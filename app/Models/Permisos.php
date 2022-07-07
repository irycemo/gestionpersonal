<?php

namespace App\Models;

use App\Models\Persona;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permisos extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['clave', 'descripcion', 'limite','creado_por', 'actualizado_por', 'tipo', 'tiempo'];

    public function personas(){
        return $this->belongsToMany(Persona::class)->withTimestamps();
    }
}
