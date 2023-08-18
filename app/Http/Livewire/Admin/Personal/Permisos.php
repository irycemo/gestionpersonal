<?php

namespace App\Http\Livewire\Admin\Personal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PermisoPersona;
use Illuminate\Support\Facades\Log;

class Permisos extends Component
{

    use WithPagination;

    public $persona;
    public $paginator = 10;
    public $selected_id;
    public $modal = false;

    public function abrirModalEliminar($id){

        $this->selected_id = $id;

        $this->modal = true;

    }

    public function eliminar(){

        try {

            PermisoPersona::destroy($this->selected_id);

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se eliminó con éxito."]);

            $this->modal = false;

        } catch (\Throwable $th) {

            Log::error("Error al borrar permiso asignado por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);

            $this->modal = false;

        }

    }

    public function render()
    {

        $permisos = PermisoPersona::with('permiso', 'creadoPor')
                                    ->where('persona_id', $this->persona->id)
                                    ->latest()
                                    ->paginate($this->paginator);

        return view('livewire.admin.personal.permisos', compact('permisos'));
    }
}
