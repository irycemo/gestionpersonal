<?php

namespace App\Models;

use App\Models\Persona;
use App\Models\Justificacion;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Retardo extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $guarded = [];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function justificacion(){
        return $this->belongsTo(Justificacion::class);
    }
}
