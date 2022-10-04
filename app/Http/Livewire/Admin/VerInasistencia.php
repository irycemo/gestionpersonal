<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Persona;
use Livewire\Component;

class VerInasistencia extends Component
{

    public $localidad;
    public $personalTotal;
    public $personalPresente;
    public $empleados = [];

    public $modal = false;

    public function consultarFaltantes(){

        $this->modal = true;

        $this->empleados = Persona::select('personas.nombre', 'personas.ap_paterno', 'personas.ap_materno')->leftJoin('checadors', function($q){
                                                        return $q->on('personas.id', 'checadors.persona_id')
                                                                    ->whereDate('checadors.created_at', '=', Carbon::today());
                                                    })
                                                    ->where('status', 'activo')
                                                    ->where('localidad', $this->localidad)
                                                    ->where('checadors.persona_id', null)
                                                    ->orderBy('nombre')
                                                    ->get();

    }

    public function render()
    {
        return view('livewire.admin.ver-inasistencia');
    }
}
