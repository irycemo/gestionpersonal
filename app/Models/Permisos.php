<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;

    protected $fillable = ['clave', 'descripcion', 'limite','creado_por', 'actualizado_por'];
}
