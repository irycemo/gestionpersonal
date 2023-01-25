<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Reportes extends Component
{

    public $area;
    public $fecha1;
    public $fecha2;

    public $verPermisos;
    public $verIncapacidades;
    public $verJustificaciones;
    public $verPersonal;
    public $verFaltas;
    public $verRetardos;

    protected function rules(){
        return [
            'fecha1' => 'required|date',
            'fecha2' => 'required|date|after:date1',
         ];
    }

    protected $messages = [
        'fecha1.required' => "La fecha inicial es obligatoria.",
        'fecha2.required' => "La fecha final es obligatoria.",
    ];

    public function updatedArea(){

        if($this->area == 'inasistencias'){

            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = false;

        }elseif($this->area == 'permisos'){

            $this->verPermisos = true;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = false;


        }elseif($this->area == 'incapacidades'){

            $this->verPermisos = false;
            $this->verIncapacidades = true;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = false;

        }elseif($this->area == 'justificaciones'){

            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = true;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = false;

        }elseif($this->area == 'personal'){

            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = true;
            $this->verRetardos = false;
            $this->verFaltas = false;


        }elseif($this->area == 'faltas'){

            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = true;



        }elseif($this->area == 'retardos'){

            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = true;
            $this->verFaltas = false;

        }

    }

    public function mount(){

        $this->area = request()->query('area');

        $this->fecha1 = request()->query('fecha1');

        $this->fecha2 = request()->query('fecha2');

        $this->updatedArea();

    }

    public function render()
    {

        return view('livewire.admin.reportes')->extends('layouts.admin');

    }
}
