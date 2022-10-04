<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Horario;
use App\Models\Persona;
use App\Models\Retardo;
use Livewire\Component;
use App\Http\Constantes;
use App\Models\Permisos;
use App\Models\Incapacidad;
use App\Exports\FaltasExport;
use App\Models\Justificacion;
use App\Models\PermisoPersona;
use App\Exports\PermisosExport;
use App\Exports\PersonalExport;
use App\Exports\RetardosExport;
use App\Exports\IncapacidadesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JustificacionesExport;

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

    public $inasistencia_empleado;

    public $permisoPermiso;
    public $personaPermiso;
    public $fecha_inicioPermiso;
    public $fecha_finalPermiso;

    public $incapacidades_empleado;
    public $incapacidades_folio;
    public $incapacidades_tipo;

    public $justificaciones_empleado;
    public $justificaciones_folio;

    public $status_empleado;
    public $localidad_empleado;
    public $area_empleado;
    public $tipo_empleado;
    public $horario_empleado;

    public $falta_empleado;
    public $falta_tipo;

    public $retardo_empleado;

    public $permisos_filtrados;
    public $incapacidades_filtradas;
    public $justificaciones_filtradas;
    public $personal_filtradas;
    public $faltas_filtradas;
    public $retardos_filtrados;

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

    public function updatedFecha1(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';

    }

    public function updatedFecha2(){

        $this->fecha2 = $this->fecha2 . ' 23:59:59';

    }

    public function updatedArea(){

        $this->reset(
            [
                'permisos_filtrados',
                'incapacidades_filtradas',
                'justificaciones_filtradas',
                'personal_filtradas',
                'faltas_filtradas',
                'retardos_filtrados',
            ]
        );

        if($this->area == 'inasistencias'){

            $this->verInasistencias = true;
            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = false;

        }elseif($this->area == 'permisos'){

            $this->verInasistencias = false;
            $this->verPermisos = true;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = false;


        }elseif($this->area == 'incapacidades'){

            $this->verInasistencias = false;
            $this->verPermisos = false;
            $this->verIncapacidades = true;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = false;

        }elseif($this->area == 'justificaciones'){

            $this->verInasistencias = false;
            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = true;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = false;

        }elseif($this->area == 'personal'){

            $this->verInasistencias = false;
            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = true;
            $this->verRetardos = false;
            $this->verFaltas = false;


        }elseif($this->area == 'faltas'){

            $this->verInasistencias = false;
            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = false;
            $this->verFaltas = true;



        }elseif($this->area == 'retardos'){

            $this->verInasistencias = false;
            $this->verPermisos = false;
            $this->verIncapacidades = false;
            $this->verJustificaciones = false;
            $this->verPersonal = false;
            $this->verRetardos = true;
            $this->verFaltas = false;


        }

    }

    public function filtrarPermisos(){

        $this->validate();

        $this->permisos_filtrados = PermisoPersona::with('persona', 'permiso')
                                            ->when (isset($this->personaPermiso) && $this->personaPermiso != "", function($q){
                                                return $q->where('persona_id', $this->personaPermiso);
                                            })
                                            ->when (isset($this->permisoPermiso) && $this->permisoPermiso != "", function($q){
                                                return $q->where('permisos_id', $this->permisoPermiso);
                                            })
                                            ->when (isset($this->fecha_inicioPermiso) && $this->fecha_inicioPermiso != "", function($q){
                                                return $q->whereDate('fecha_inicio','<=', Carbon::createFromFormat('Y-m-d', $this->fecha_inicioPermiso));
                                            })
                                            ->when (isset($this->fecha_finalPermiso) && $this->fecha_finalPermiso != "", function($q){
                                                return $q->whereDate('fecha_final','>=', Carbon::createFromFormat('Y-m-d', $this->fecha_finalPermiso));
                                            })
                                            ->whereBetween('created_at', [$this->fecha1, $this->fecha2])
                                            ->get();

    }

    public function filtrarIncapacidades(){

        $this->validate();

        $this->incapacidades_filtradas=Incapacidad::with('creadoPor', 'actualizadoPor','persona')
                                                    ->when(isset($this->incapacidades_folio) && $this->incapacidades_folio != "", function($q){
                                                        return $q->where('folio', $this->incapacidades_folio);

                                                    })
                                                    ->when(isset($this->incapacidades_tipo) && $this->incapacidades_tipo != "", function($q){
                                                        return $q->where('tipo','like', '%'.$this->incapacidades_tipo.'%');

                                                    })->when(isset($this->incapacidades_empleado) && $this->incapacidades_empleado != "", function($q){
                                                        return $q->where('persona_id', $this->incapacidades_empleado);
                                                    })
                                                    ->whereBetween('created_at', [$this->fecha1, $this->fecha2])
                                                    ->get();

    }

    public function filtrarJustificaciones(){

        $this->validate();

        $this->justificaciones_filtradas=Justificacion::with('creadoPor', 'actualizadoPor','persona', 'falta', 'retardo')
                                                    ->when(isset($this->justificaciones_folio) && $this->justificaciones_folio != "", function($q){
                                                        return $q->where('folio', $this->justificaciones_folio);

                                                    })
                                                    ->when(isset($this->justificaciones_empleado) && $this->justificaciones_empleado != "", function($q){
                                                        return $q->where('persona_id', $this->justificaciones_empleado);
                                                    })
                                                    ->whereBetween('created_at', [$this->fecha1, $this->fecha2])
                                                    ->get();

    }

    public function filtrarPersonal(){

        $this->validate();

        $this->personal_filtradas=Persona::with('creadoPor', 'actualizadoPor','horario')
                                            ->when(isset($this->status_empleado) && $this->status_empleado != "", function($q){
                                                return $q->where('status', $this->status_empleado);

                                            })
                                            ->when(isset($this->localidad_empleado) && $this->localidad_empleado != "", function($q){
                                                return $q->where('localidad', $this->localidad_empleado);
                                            })
                                            ->when(isset($this->area_empleado) && $this->area_empleado != "", function($q){
                                                return $q->where('area', $this->area_empleado);
                                            })
                                            ->when(isset($this->tipo_empleado) && $this->tipo_empleado != "", function($q){
                                                return $q->where('tipo', $this->tipo_empleado);
                                            })
                                            ->when(isset($this->horario_empleado) && $this->horario_empleado != "", function($q){
                                                return $q->where('horario_id', $this->horario_empleado);
                                            })
                                            ->whereBetween('created_at', [$this->fecha1, $this->fecha2])
                                            ->get();

    }

    public function filtrarFaltas(){

        $this->validate();

        $this->faltas_filtradas = Falta::with('persona', 'creadoPor', 'actualizadoPor')
                                        ->when(isset($this->falta_empleado) && $this->falta_empleado != "", function($q){
                                            return $q->where('persona_id', $this->falta_empleado);
                                        })
                                        ->when(isset($this->falta_tipo) && $this->falta_tipo != "", function($q){
                                            return $q->where('tipo', 'like','%'.$this->falta_tipo.'%');
                                        })
                                        ->whereBetween('created_at', [$this->fecha1, $this->fecha2])
                                        ->get();

    }

    public function filtrarRetardos(){

        $this->validate();

        $this->retardos_filtrados = Retardo::with('persona', 'creadoPor', 'actualizadoPor')
                                            ->when(isset($this->retardo_empleado) && $this->retardo_empleado != "", function($q){
                                                return $q->where('persona_id', $this->retardo_empleado);
                                            })
                                            ->whereBetween('created_at', [$this->fecha1, $this->fecha2])
                                            ->get();

    }

    public function descargarExcel($modelo){

        if($modelo == 'permisos')
            return Excel::download(new PermisosExport($this->permisos_filtrados), 'Reporte_de_permisos_' . now()->format('d-m-Y') . '.xlsx');

        if($modelo == 'incapacidades')
            return Excel::download(new IncapacidadesExport($this->incapacidades_filtradas), 'Reporte_de_incapacidades_' . now()->format('d-m-Y') . '.xlsx');

        if($modelo == 'justificaciones')
            return Excel::download(new JustificacionesExport($this->justificaciones_filtradas), 'Reporte_de_justificaciones_' . now()->format('d-m-Y') . '.xlsx');

        if($modelo == 'personal')
            return Excel::download(new PersonalExport($this->personal_filtradas), 'Reporte_de_personal_' . now()->format('d-m-Y') . '.xlsx');

        if($modelo == 'faltas')
            return Excel::download(new FaltasExport($this->faltas_filtradas), 'Reporte_de_faltas_' . now()->format('d-m-Y') . '.xlsx');

        if($modelo == 'retardos')
            return Excel::download(new RetardosExport($this->retardos_filtrados), 'Reporte_de_retardos_' . now()->format('d-m-Y') . '.xlsx');
    }

    public function mount(){

        $this->area = request()->query('area');

        $this->fecha1 = request()->query('fecha1');

        $this->fecha2 = request()->query('fecha2');

        $this->updatedArea();

        if($this->area == 'faltas')
            $this->filtrarFaltas();
        elseif($this->area == 'retardos')
            $this->filtrarRetardos();
        elseif($this->area == 'permisos')
            $this->filtrarPermisos();

    }

    public function render()
    {

        $empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->get();

        $permisos = Permisos::select('id', 'descripcion')->get();

        $horarios = Horario::all();

        $localidades = Constantes::LOCALIDADES;

        $areas = Constantes::AREAS;

        $tipos = Constantes::TIPO;

        return view('livewire.admin.reportes', compact('empleados','horarios','localidades','areas', 'tipos', 'permisos'))->extends('layouts.admin');

    }
}
