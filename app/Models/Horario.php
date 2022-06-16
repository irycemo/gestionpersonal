<?php

namespace App\Models;

use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable  = [
        'tipo',
        'entrada',
        'salida',
        'entrada_mixta',
        'salida_mixta',
        'tolerancia',
        'falta',
        'descripcion',
        'creado_por',
        'actualizado_por'
    ];
}
