<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\ComponentesTrait;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Permisos;

class Permisospersonal extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $clave;
    public $descripcion;
    public $limite;


    protected function rules(){
        return [
            'clave'=>'required',
            'descripcion' => 'required',
            'limite' => 'required'

         ];
    }

    protected $messages = [
        'clave.required' => 'El campo clave es requerido',
        'descripcion.required' => 'El campo descripción es requerido',
        'limite.required' =>'El campo límite es requerido'
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal','clave', 'descripcion', 'limite']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abiriModalEditar($permisospersonal){


        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;
        $this->selected_id = $permisospersonal['id'];

        $this ->clave = $permisospersonal['clave'];
        $this->descripcion = $permisospersonal['descripcion'];
        $this->limite = $permisospersonal['limite'];



    }

    public function crear(){

        $this->validate();

        try {

            $permisospersonal = permisos::create([

                'clave'=> $this->clave,
                'descripcion' => $this->descripcion,
                'limite' => $this->limite,
                'creado_por' => auth()->user()->id,
                'actualizado_por' => auth()->user()->id,

            ]);



            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se creó con éxito."]);

        } catch (\Throwable $th) {
            dd($th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
            $this->resetearTodo();
        }

    }

    public function actualizar(){

        try{



            $permiso = Permisos::find($this->selected_id);

            $permiso->update([
                'clave'=> $this->clave,
                'descripcion' => $this->descripcion,
                'limite' => $this->limite,
                'actualizado_por' => auth()->user()->id
            ]);


            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se actualizó con éxito."]);

        } catch (\Throwable $th) {

            dd($th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
            $this->resetearTodo();
        }

    }

    public function borrar(){

        try{

            $permiso = Permisos::find($this->selected_id);

            $permiso->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se elimino con exito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
            $this->resetearTodo();
        }

    }

    public function render()
    {
        $permisos = Permisos::where('clave','like', '%'.$this->search.'%')
                            ->orWhere('descripcion','like', '%'.$this->search.'%')
                            ->orWhere('limite','like', '%'.$this->search.'%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);


        return view('livewire.admin.permisospersonal', compact('permisos'))->extends('layouts.admin');
    }
}
