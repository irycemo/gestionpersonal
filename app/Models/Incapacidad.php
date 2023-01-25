<?php

namespace App\Models;

use Carbon\Carbon;
use App\Http\Traits\ModelosTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Incapacidad extends Model
{
    use HasFactory;
    use ModelosTrait;

    protected $fillable = ['folio', 'documento', 'tipo', 'persona_id', 'creado_por', 'actualizado_por', 'fecha_inicial', 'fecha_final'];

    /* protected $casts = [
        'fecha_inicial' => 'date:d-m-Y',
        'fecha_final' => 'date:d-m-Y',
    ]; */

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function imagenUrl(){

        return $this->documento
                    ? Storage::disk('incapacidades')->url($this->documento)
                    : Storage::disk('public')->url('img/logo2.png');

    }

    public function getFechaInicialAttribute(){
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_inicial'])->format('d-m-Y');
    }

    public function getFechaFinalAttribute(){
        return Carbon::createFromFormat('Y-m-d', $this->attributes['fecha_final'])->format('d-m-Y');
    }

}
