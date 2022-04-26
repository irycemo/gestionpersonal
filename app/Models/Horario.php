<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable  = ['tipo', 'entrada', 'salida'];

    public function creadoPor(){
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function actualizadoPor(){
        return $this->belongsTo(User::class, 'actualizado_por');
    }
}
