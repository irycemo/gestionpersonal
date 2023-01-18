<?php

namespace App\Http\Livewire\Admin;

use App\Models\Persona;
use Livewire\Component;
use App\Models\Incapacidad;
use App\Exports\IncapacidadesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteIncapacidad extends Component
{

    public $incapacidades_folio;
    public $incapacidades_tipo;
    public $incapacidades_empleado;
    public $fecha1;
    public $fecha2;

    public $pagination = 10;

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        return Excel::download(new IncapacidadesExport($this->incapacidades_folio, $this->incapacidades_tipo, $this->incapacidades_empleado, $this->fecha1, $this->fecha2), 'Reporte_de_incapacidades_' . now()->format('d-m-Y') . '.xlsx');

    }

    public function render()
    {

        $empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        $incapacidades = Incapacidad::with('creadoPor', 'actualizadoPor','persona')
                                        ->when(isset($this->incapacidades_folio) && $this->incapacidades_folio != "", function($q){
                                            return $q->where('folio', $this->incapacidades_folio);

                                        })
                                        ->when(isset($this->incapacidades_tipo) && $this->incapacidades_tipo != "", function($q){
                                            return $q->where('tipo','like', '%'.$this->incapacidades_tipo.'%');

                                        })->when(isset($this->incapacidades_empleado) && $this->incapacidades_empleado != "", function($q){
                                            return $q->where('persona_id', $this->incapacidades_empleado);
                                        })
                                        ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                                        ->paginate($this->pagination);

        return view('livewire.admin.reporte-incapacidad', compact('incapacidades', 'empleados'));
    }
}
