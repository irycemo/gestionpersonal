<?php

namespace App\Models;

use Carbon\Carbon;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inasistencia extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['motivo', 'archivo', 'fecha', 'persona_id', 'creado_por', 'actualizado_por'];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

}
