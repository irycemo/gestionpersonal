<?php

namespace App\Http\Livewire\Admin;

use App\Models\Persona;
use Livewire\Component;
use App\Models\Justificacion;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JustificacionesExport;

class ReporteJustificacion extends Component
{

    public $justificaciones_folio;
    public $justificaciones_empleado;
    public $fecha1;
    public $fecha2;

    public $pagination = 10;

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        return Excel::download(new JustificacionesExport($this->justificaciones_folio, $this->justificaciones_empleado, $this->fecha1, $this->fecha2), 'Reporte_de_justificaciones_' . now()->format('d-m-Y') . '.xlsx');

    }

    public function render()
    {

        $empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        $justificaciones = Justificacion::with('creadoPor', 'actualizadoPor','persona', 'falta', 'retardo')
                                            ->when(isset($this->justificaciones_folio) && $this->justificaciones_folio != "", function($q){
                                                return $q->where('folio', $this->justificaciones_folio);

                                            })
                                            ->when(isset($this->justificaciones_empleado) && $this->justificaciones_empleado != "", function($q){
                                                return $q->where('persona_id', $this->justificaciones_empleado);
                                            })
                                            ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                                            ->paginate($this->pagination);

        return view('livewire.admin.reporte-justificacion', compact('justificaciones', 'empleados'));
    }
}
