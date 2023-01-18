<?php

namespace App\Http\Livewire\Admin;

use App\Models\Persona;
use App\Models\Retardo;
use Livewire\Component;
use App\Exports\RetardosExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteRetardo extends Component
{

    public $retardo_empleado;
    public $fecha1;
    public $fecha2;

    public $pagination = 10;

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        return Excel::download(new RetardosExport($this->retardo_empleado, $this->fecha1, $this->fecha2), 'Reporte_de_retardos_' . now()->format('d-m-Y') . '.xlsx');

    }

    public function render()
    {

        $empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        $retardos = Retardo::with('persona', 'creadoPor', 'actualizadoPor')
                                ->when(isset($this->retardo_empleado) && $this->retardo_empleado != "", function($q){
                                    return $q->where('persona_id', $this->retardo_empleado);
                                })
                                ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                                ->paginate($this->pagination);

        return view('livewire.admin.reporte-retardo', compact('retardos', 'empleados'));
    }
}
