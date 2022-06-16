<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Persona;
use App\Models\Retardo;
use Livewire\Component;
use App\Models\Checador as CH;

class Checador extends Component
{

    public $persona;
    public $codigo;
    public $checados;
    public $flag = false;

    public function capturarCodigo(){

        $this->flag = false;

        $hora = now();

        $this->persona = Persona::where('codigo_barras', $this->codigo)->first();

        if($this->persona == null || $this->codigo == null){

            $this->codigo = null;
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No se encuentra la persona ó código incorrecto."]);
            return;

        }

        $this->checados = CH::where('persona_id', $this->persona->id)->whereDate('created_at', '=', Carbon::today()->toDateString())->get();



        if($this->checados->count() > 0){

            if($this->checados->last()->created_at->diffInMinutes(now()) > 2){

                if($this->checados->last()->tipo == 'entrada'){

                    $this->checar($hora, 'salida');

                }else{

                    $this->checar($hora, 'entrada');

                }

            }else{

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Debe esperar almenos 2 minutos para hacer un nuevo registro."]);

            }

        }else{

            $ch = $this->checar($hora, 'entrada');

            $this->retardoFalta($ch);

        }

        $this->checados = CH::where('persona_id', $this->persona->id)->whereDate('created_at', '=', Carbon::today()->toDateString())->get();

        $this->flag = true;

        $this->dispatchBrowserEvent('contador');

        $this->codigo = null;

    }

    public function checar($hora, $tipo){

        $ch = CH::create([
            'hora' => $hora,
            'tipo' => $tipo,
            'persona_id' => $this->persona->id
        ]);

        $this->dispatchBrowserEvent('mostrarMensaje', ['success', "Registro exitoso."]);

        return $ch;

    }

    public function retardoFalta($checador){

        $horario = $this->persona->horario;

        $hr = $checador->created_at->diffInMinutes($horario->entrada);

        if($horario->falta < $hr){

            Falta::create([
                'tipo' => '30 min tarde',
                'persona_id' => $this->persona->id
            ]);

        }elseif($horario->tolerancia < $hr){

            Retardo::create([
                'status' => 1,
                'persona_id' => $this->persona->id
            ]);
        }

    }

    public function render()
    {
        return view('livewire.checador');
    }
}
