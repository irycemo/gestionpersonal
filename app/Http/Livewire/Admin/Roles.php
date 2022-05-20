<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends Component
{

    public $modal = false;
    public $modalBorrar = false;
    public $crear = false;
    public $editar = false;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $pagination=10;
    public $selected_id;

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

    public function order($sort){

        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function updatedPagination(){
        $this->resetPage();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'nombre', 'listaDePermisos']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalBorrar($model){

        $this->modalBorrar = true;

        $this->selected_id = $model['id'];

    }

    public function abrirModalCrear(){
        $this->resetearTodo();
        $this->modal = true;
        $this->crear =true;
    }

    public function abiriModalEditar($modelo){

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
                'name' => $this->nombre
            ]);

            $role->permissions()->sync($this->listaDePermisos);

            $this->cerrarModal();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El role se creó con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->cerrarModal();
            $this->resetearTodo();
        }

    }

    public function actualizar(){

        try{

            $rol = Role::find($this->selected_id);

            $rol->update([
                'name' => $this->nombre
            ]);

            $rol->permissions()->sync($this->listaDePermisos);

            $this->cerrarModal();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El rol se actualizó con éxito."]);

        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->cerrarModal();
            $this->resetearTodo();
        }

    }

    public function borrar(){

        try{

            $role = Role::find($this->selected_id);

            $role->delete();

            $this->cerrarModal();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El role se elimino con exito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->cerrarModal();
            $this->resetearTodo();
        }

    }

    public function render()
    {

        $roles = Role::with('permissions')->where('name', 'LIKE', '%' . $this->search . '%')
                            ->paginate($this->pagination);

        $permisos = Permission::all();

        $permisos = $permisos->groupBy(function($permiso) {
            return $permiso->area;
        })->all();

        return view('livewire.admin.roles', compact('roles', 'permisos'))->extends('layouts.admin');
    }
}
