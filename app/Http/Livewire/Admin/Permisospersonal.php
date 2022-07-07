<?php

namespace App\Http\Livewire\Admin;

use App\Models\Persona;
use Livewire\Component;
use App\Models\Permisos;
use Livewire\WithPagination;
use App\Http\Traits\ComponentesTrait;

class Permisospersonal extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $clave;
    public $descripcion;
    public $limite;
    public $tipo;
    public $tiempo;

    public $modalAsignar = false;
    public $empleado_id;
    public $empleado;
    public $permiso_id;
    public $permiso_limite;


    protected function rules(){
        return [
            'clave'=>'required',
            'descripcion' => 'required',
            'limite' => 'required',
            'empleado_id' => 'required',
            'tipo' => 'required',
            'tiempo' => 'required'
         ];
    }

    protected $messages = [
        'clave.required' => 'El campo clave es requerido',
        'descripcion.required' => 'El campo descripción es requerido',
        'limite.required' =>'El campo límite es requerido',
        'empleado_id.required' =>'El campo empleado es requerido'
    ];

    public function updatedEmpleadoId(){

        $this->empleado = Persona::with('permisos')->find($this->empleado_id);

        $permisosSolicitados = $this->empleado->permisos()->where('permisos_id', $this->permiso_id)->count();

        if($permisosSolicitados >= $this->permiso_limite){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "El empleado ya ha superado el límite de permisos permitidos este mes."]);

            $this->resetearTodo();
        }

    }

    public function resetearTodo(){

        $this->reset(['tiempo', 'tipo', 'permiso_id', 'modalAsignar', 'empleado_id', 'modalBorrar', 'crear', 'editar', 'modal','clave', 'descripcion', 'limite']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abiriModalEditar($permisospersonal){


        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;
        $this->selected_id = $permisospersonal['id'];

        $this ->clave = $permisospersonal['clave'];
        $this ->tipo = $permisospersonal['tipo'];
        $this ->tiempo = $permisospersonal['tiempo'];
        $this->descripcion = $permisospersonal['descripcion'];
        $this->limite = $permisospersonal['limite'];



    }

    public function abiriModalAsignar($permiso){

        $this->modalAsignar = true;
        $this->permiso_id = $permiso['id'];
        $this->permiso_limite = $permiso['limite'];

    }

    public function crear(){

        $this->validate();

        try {

            $permisospersonal = permisos::create([

                'clave'=> $this->clave,
                'tipo'=> $this->tipo,
                'tiempo'=> $this->tiempo,
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
                'tipo'=> $this->tipo,
                'tiempo'=> $this->tiempo,
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

    public function asignarPermiso(){

        $this->empleado->permisos()->attach($this->permiso_id, ['creado_por' => auth()->user()->id]);

        $this->resetearTodo();

    }

    public function render()
    {

        $empleados = Persona::all();

        $permisos = Permisos::where('clave','like', '%'.$this->search.'%')
                            ->orWhere('descripcion','like', '%'.$this->search.'%')
                            ->orWhere('tipo','like', '%'.$this->search.'%')
                            ->orWhere('limite','like', '%'.$this->search.'%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);


        return view('livewire.admin.permisospersonal', compact('permisos', 'empleados'))->extends('layouts.admin');
    }
}
