<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incapacidad extends Model
{
    use HasFactory;

    protected $fillable = ['folio', 'documento', 'tipo', 'persona_id', 'creado_por', 'actualizdo_por'];

    public function creadoPor(){
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function actualizadoPor(){
        return $this->belongsTo(User::class, 'actualizado_por');
    }
}
