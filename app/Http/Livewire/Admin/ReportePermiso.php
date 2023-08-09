<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Permisos;
use Livewire\WithPagination;
use App\Models\PermisoPersona;
use App\Exports\PermisosExport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportePermiso extends Component
{

    use WithPagination;

    public $personaPermiso;
    public $permisoPermiso;
    public $fecha_inicioPermiso;
    public $fecha_finalPermiso;
    public $fecha1;
    public $fecha2;

    public $pagination = 10;

    public function descargarExcel(){

        $this->fecha1 = $this->fecha1 . ' 00:00:00';
        $this->fecha2 = $this->fecha2 . ' 23:59:59';

        try {

            return Excel::download(new PermisosExport($this->personaPermiso, $this->permisoPermiso, $this->fecha_inicioPermiso, $this->fecha_finalPermiso, $this->fecha1, $this->fecha2), 'Reporte_de_permisos_' . now()->format('d-m-Y') . '.xlsx');

        } catch (\Throwable $th) {

            Log::error("Error generar archivo de reporte de incapacidades por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function render()
    {

        $empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        $permisosLista = Permisos::select('id', 'descripcion')->orderBy('descripcion')->get();

        $permisos = PermisoPersona::with('persona', 'permiso', 'creadoPor')
                                        ->when (isset($this->personaPermiso) && $this->personaPermiso != "", function($q){
                                            return $q->where('persona_id', $this->personaPermiso);
                                        })
                                        ->when (isset($this->permisoPermiso) && $this->permisoPermiso != "", function($q){
                                            return $q->where('permisos_id', $this->permisoPermiso);
                                        })
                                        ->whereBetween('created_at', [$this->fecha1 . ' 00:00:00', $this->fecha2 . ' 23:59:59'])
                                        ->paginate($this->pagination);

        return view('livewire.admin.reporte-permiso', compact('permisos', 'empleados', 'permisosLista'));
    }
}
