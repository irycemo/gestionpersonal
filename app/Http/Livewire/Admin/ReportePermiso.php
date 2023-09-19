<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Permisos;
use Livewire\WithPagination;
use App\Models\PermisoPersona;
use App\Exports\PermisosExport;
use App\Http\Constantes;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportePermiso extends Component
{

    use WithPagination;

    public $areas;
    public $area;
    public $empleados;
    public $personaPermiso;
    public $permisoPermiso;
    public $fecha_inicioPermiso;
    public $fecha_finalPermiso;
    public $fecha1;
    public $fecha2;

    public $pagination = 10;

    public function updatedArea(){

        if($this->area === ""){

            $this->empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        }else{

            $this->empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->where('area', $this->area)->orderBy('nombre')->get();

        }

    }

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        try {

            return Excel::download(new PermisosExport($this->area, $this->personaPermiso, $this->permisoPermiso, $this->fecha_inicioPermiso, $this->fecha_finalPermiso, $this->fecha1, $this->fecha2), 'Reporte_de_permisos_' . now()->format('d-m-Y') . '.xlsx');

        } catch (\Throwable $th) {

            Log::error("Error generar archivo de reporte de incapacidades por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function mount(){

        $this->areas = Constantes::AREAS_ADSCRIPCION;

        $this->empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

    }

    public function render()
    {

        $permisosLista = Permisos::select('id', 'descripcion')->orderBy('descripcion')->get();

        $permisos = PermisoPersona::with('persona', 'permiso', 'creadoPor')
                                        ->when (isset($this->area) && $this->area != "", function($q){
                                            return $q->whereHas('persona', function($q){
                                                $q->where('area', $this->area);
                                            });
                                        })
                                        ->when (isset($this->personaPermiso) && $this->personaPermiso != "", function($q){
                                            return $q->where('persona_id', $this->personaPermiso);
                                        })
                                        ->when (isset($this->permisoPermiso) && $this->permisoPermiso != "", function($q){
                                            return $q->where('permisos_id', $this->permisoPermiso);
                                        })
                                        ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                                        ->paginate($this->pagination);

        return view('livewire.admin.reporte-permiso', compact('permisos', 'permisosLista'));
    }
}
