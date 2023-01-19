<?php

namespace App\Http\Livewire\Admin;

use App\Models\Horario;
use App\Models\Persona;
use Livewire\Component;
use App\Http\Constantes;
use Livewire\WithPagination;
use App\Exports\PersonalExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportePersonal extends Component
{

    use WithPagination;

    public $status_empleado;
    public $localidad_empleado;
    public $area_empleado;
    public $tipo_empleado;
    public $horario_empleado;
    public $fecha1;
    public $fecha2;

    public $pagination = 10;

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        return Excel::download(new PersonalExport($this->status_empleado, $this->localidad_empleado, $this->area_empleado, $this->tipo_empleado, $this->horario_empleado, $this->fecha1, $this->fecha2), 'Reporte_de_personal_' . now()->format('d-m-Y') . '.xlsx');

    }

    public function render()
    {

        $localidades = Constantes::LOCALIDADES;

        $areas = Constantes::AREAS_ADSCRIPCION;

        $horarios = Horario::all();

        $tipos = Constantes::TIPO;

        $personal = Persona::with('creadoPor', 'actualizadoPor','horario')
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
                                ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                                ->paginate($this->pagination);


        return view('livewire.admin.reporte-personal', compact('personal', 'localidades', 'areas', 'tipos', 'horarios'));
    }
}
