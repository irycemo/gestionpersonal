<?php

namespace App\Models;

use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Justificacion extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['folio', 'documento', 'persona_id', 'creado_por', 'actualizdo_por'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }
}
