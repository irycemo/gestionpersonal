<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Http\Constantes;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;

class Permisos extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $nombre;
    public $area;

    protected function rules(){
        return [
            'nombre' => 'required',
            'area' => 'required'
         ];
    }

    protected $messages = [
        'nombre.required' => 'El campo nombre es requerido',
        'area.required' => 'El campo área es requerido',
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'nombre', 'area']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->nombre = $modelo['name'];
        $this->area = $modelo['area'];

    }

    public function crear(){

        $this->validate();

        try {

            $permiso = Permission::create([
                'name' => $this->nombre,
                'area' => $this->area,
                'creado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear permiso (spatie) por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        $this->validate();

        try{

            $permiso = Permission::find($this->selected_id);

            $permiso->update([
                'name' => $this->nombre,
                'area' => $this->area,
                'actualizado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar permiso (spatie) por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $permiso = Permission::find($this->selected_id);

            $permiso->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se eliminó con éxito."]);

        } catch (\Throwable $th) {
            Log::error("Error al borrar permiso (spatie) por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {

        $areas = collect(Constantes::AREAS)->sort();

        $permisos = Permission::with('creadoPor', 'actualizadoPor')
                                ->where('name', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('area', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

        return view('livewire.admin.permisos', compact('permisos', 'areas'))->extends('layouts.admin');
    }
}
