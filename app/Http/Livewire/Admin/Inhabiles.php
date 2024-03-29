<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Inhabil;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;

class Inhabiles extends Component
{
    use WithPagination;
    use ComponentesTrait;
    use WithFileUploads;

    public $fecha;
    public $descripcion;


    protected function rules(){
        return [
            'fecha' => 'required',
            'descripcion' => 'required',

         ];
    }

    protected $messages = [
        'fecha.required' => 'El campo fecha es obligatorio',
        'descripcion.required' => 'El campo descripción es obligatorio',

    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar','crear', 'editar', 'modal', 'fecha', 'descripcion']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abiriModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->fecha = Carbon::createFromFormat('d-m-Y', $modelo['fecha'])->format('Y-m-d');
        $this->descripcion = $modelo['descripcion'];


    }

    public function crear(){

        $this->validate();

        try {

            $Inhabil = Inhabil::create([
                'fecha' => $this->fecha,
                'descripcion' => $this->descripcion,
                'creado_por' => auth()->user()->id
            ]);


            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El día inhábil se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear día inhabil por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        $this->validate();

        try{

            $Inhabil = Inhabil::find($this->selected_id);

            $Inhabil->update([
                'fecha' => $this->fecha,
                'descripcion' => $this->descripcion,
                'actualizado_por' => auth()->user()->id

            ]);


            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El día inhábil se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar día inhabil por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }




    public function borrar(){

        try{

            $Inhabil = Inhabil::find($this->selected_id);

            $Inhabil->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El día inhábil se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar día inhabil por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {



        $inhabiles = Inhabil::with('creadoPor','actualizadoPor')
                                ->where('fecha', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('creado_por', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('actualizado_por', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);



        return view('livewire.admin.inhabiles', compact('inhabiles'))->extends('layouts.admin');
    }
}
