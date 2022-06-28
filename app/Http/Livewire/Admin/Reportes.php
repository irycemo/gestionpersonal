<?php

namespace App\Http\Livewire\Admin;

use App\Models\Persona;
use Livewire\Component;
use App\Models\Permisos;
use App\Models\Inasistencia;
use App\Exports\PermisosExport;
use App\Exports\InasistenciasExport;
use Maatwebsite\Excel\Facades\Excel;

class Reportes extends Component
{

    public $area;
    public $fecha1;
    public $fecha2;

    public $verInasistencias;
    public $verPermisos;

    public $inasistencia_empleado;

    public $clavePermiso;
    public $descripcionPermiso;

    public $inasistencias_filtradas;
    public $permisos_filtrados;

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

            $this->verInasistencias = true;
            $this->verPermisos = false;

        }elseif($this->area == 'permisos'){

            $this->verInasistencias = false;
            $this->verPermisos = true;

        }

    }

    public function filtrarInasistencias(){

        $this->validate();

        $this->inasistencias_filtradas = Inasistencia::with('persona', 'creadoPor', 'actualizadoPor')
                                                        ->when(isset($this->inasistencia_empleado) && $this->inasistencia_empleado != "", function($q){
                                                            return $q->where('persona_id', $this->inasistencia_empleado);
                                                        })
                                                        ->whereBetween('created_at', [$this->fecha1, $this->fecha2])
                                                        ->get();

    }

    public function filtrarPermisos(){

        $this->validate();

        $this->permisos_filtrados=Permisos::with('creadoPor', 'actualizadoPor')
                                            ->when(isset($this->clavePermiso) && $this->clavePermiso != "", function($q){
                                                return $q->where('clave', $this->clavePermiso);

                                            })
                                            ->when (isset($this->descripcionPermiso) && $this->descripcionPermiso != "", function($q){
                                                return $q->where('descripcion','like','%'.$this->descripcionPermiso.'%');
                                            })
                                            ->whereBetween('created_at', [$this->fecha1, $this->fecha2])
                                            ->get();

    }

    public function descargarExcel($modelo){

        if($modelo == 'inasistencias')
            return Excel::download(new InasistenciasExport($this->inasistencias_filtradas), 'Reporte_de_inasistencias_' . now()->format('d-m-Y') . '.xlsx');

        if($modelo == 'permisos')
            return Excel::download(new PermisosExport($this->permisos_filtrados), 'Reporte_de_permisos_' . now()->format('d-m-Y') . '.xlsx');

    }

    public function render()
    {

        $empleados = Persona::all();

        return view('livewire.admin.reportes', compact('empleados'))->extends('layouts.admin');
    }
}
