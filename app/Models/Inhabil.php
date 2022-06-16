<?php

namespace App\Models;

use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inhabil extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['fecha','descripcion', 'creado_por', 'actualizado_por'];
}
