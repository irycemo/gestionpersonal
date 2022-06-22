<?php

namespace App\Models;

use App\Models\Falta;
use App\Models\Retardo;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Justificacion extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['folio', 'documento', 'persona_id', 'creado_por', 'actualizdo_por'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function retardo(){
        return $this->hasOne(Retardo::class);
    }

    public function falta(){
        return $this->hasOne(Falta::class);
    }
}
