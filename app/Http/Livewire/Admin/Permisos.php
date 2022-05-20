<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permisos extends Component
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
        $this->area = $modelo['area'];

    }

    public function crear(){

        $this->validate();

        try {

            $permiso = Permission::create([
                'name' => $this->nombre,
                'area' => $this->area,
            ]);

            $this->cerrarModal();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se creó con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->cerrarModal();
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
            ]);

            $this->cerrarModal();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se actualizó con éxito."]);

        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->cerrarModal();
            $this->resetearTodo();
        }

    }

    public function borrar(){

        try{

            $permiso = Permission::find($this->selected_id);

            $permiso->delete();

            $this->cerrarModal();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se elimino con exito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->cerrarModal();
            $this->resetearTodo();
        }

    }

    public function render()
    {

        $permisos = Permission::where('name', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('area', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

        return view('livewire.admin.permisos', compact('permisos'))->extends('layouts.admin');
    }
}
