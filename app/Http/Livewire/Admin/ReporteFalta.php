<?php

namespace App\Http\Livewire\Admin;

use App\Models\Falta;
use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\FaltasExport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReporteFalta extends Component
{

    use WithPagination;

    public $falta_empleado;
    public $falta_tipo;
    public $fecha1;
    public $fecha2;

    public $pagination = 10;

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        try {

            return Excel::download(new FaltasExport($this->falta_empleado, $this->falta_tipo, $this->fecha1, $this->fecha2), 'Reporte_de_faltas_' . now()->format('d-m-Y') . '.xlsx');

        } catch (\Throwable $th) {

            Log::error("Error generar archivo de reporte de faltas por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function render()
    {

        $empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        $faltas = Falta::with('persona', 'justificacion')
                            ->when(isset($this->falta_empleado) && $this->falta_empleado != "", function($q){
                                return $q->where('persona_id', $this->falta_empleado);
                            })
                            ->when(isset($this->falta_tipo) && $this->falta_tipo != "", function($q){
                                return $q->where('tipo', 'like','%'.$this->falta_tipo.'%');
                            })
                            ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                            ->paginate($this->pagination);

        return view('livewire.admin.reporte-falta',compact('faltas', 'empleados'));
    }
}
