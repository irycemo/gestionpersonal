<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;

class Roles extends Component
{
    use WithPagination;
    use ComponentesTrait;

    public $nombre;
    public $listaDePermisos = [];

    protected function rules(){
        return [
            'nombre' => 'required'
         ];
    }

    protected $messages = [
        'nombre.required' => 'El campo nombre es requerido'
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'nombre', 'listaDePermisos']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->nombre = $modelo['name'];

        foreach($modelo['permissions'] as $permission){
            array_push($this->listaDePermisos, (string)$permission['id']);
        }

    }

    public function crear(){

        $this->validate();

        try {

            $role = Role::create([
                'name' => $this->nombre,
                'creado_por' => auth()->user()->id
            ]);

            $role->permissions()->sync($this->listaDePermisos);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El role se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear rol por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        try{

            $rol = Role::find($this->selected_id);

            $rol->update([
                'name' => $this->nombre,
                'actualizado_por' => auth()->user()->id
            ]);

            $rol->permissions()->sync($this->listaDePermisos);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El rol se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar rol por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function borrar(){

        try{

            $role = Role::find($this->selected_id);

            $role->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El role se elimino con exito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar rol por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {

        $roles = Role::with('permissions', 'creadoPor', 'actualizadoPor')->where('name', 'LIKE', '%' . $this->search . '%')
                            ->paginate($this->pagination);

        $permisos = Permission::all();

        $permisos = $permisos->groupBy(function($permiso) {
            return $permiso->area;
        })->all();

        return view('livewire.admin.roles', compact('roles', 'permisos'))->extends('layouts.admin');
    }
}
