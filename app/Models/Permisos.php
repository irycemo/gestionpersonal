<?php

namespace App\Models;

use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['clave', 'descripcion', 'limite','creado_por', 'actualizado_por'];
}
