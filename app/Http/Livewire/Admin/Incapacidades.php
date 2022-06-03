<?php

namespace App\Http\Livewire\Admin;

use App\Models\Persona;
use Livewire\Component;
use App\Models\Incapacidad;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class Incapacidades extends Component
{
    use WithPagination;
    use WithFileUploads;
    use ComponentesTrait;

    public $folio;
    public $documento;
    public $tipo;
    public $persona;

    protected function rules(){
        return [
            'folio' => 'required',
            'documento' => 'required|mimes:jpg,png,jpeg',
            'tipo' => 'required',
            'persona' => 'required'
         ];
    }

    protected $messages = [
        'folio.required' => 'El campo folio es requerido',
        'documento.required' => 'El campo documento es requerido',
        'tipo.required' => 'El campo tipo es requerido'
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'folio', 'documento', 'tipo', 'persona']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abiriModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->folio = $modelo['folio'];
        $this->documento = $modelo['documento'];
        $this->tipo = $modelo['tipo'];
        $this->persona = $modelo['persona'];

    }

    public function crear(){

        $this->validate();

        try {

            $incapacidad = Incapacidad::create([
                'folio' => $this->folio,
                'tipo' => $this->tipo,
                'persona_id' => $this->persona,
                'creado_por' => auth()->user()->id
            ]);

            if($this->documento){

                $nombreArchivo = $this->documento->store('/', 'incapacidades');

                $this->dispatchBrowserEvent('removeFiles');

            }else{

                $nombreArchivo = null;
            }

            $incapacidad->update([
                'documento' => $nombreArchivo
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La incapacidad se creó con éxito."]);

        } catch (\Throwable $th) {
            dd($th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        $this->validate();

        try{

            $incapacidad = Incapacidad::find($this->selected_id);

            $incapacidad->update([
                'folio' => $this->folio,
                'documento' => $this->documento,
                'tipo' => $this->tipo,
                'actualizado_por' => auth()->user()->id
            ]);

            if($this->documento){

                Storage::disk('incapacidades')->delete($incapacidad->documento);

                $nombreArchivo = $this->documento->store('/', '');

                $this->dispatchBrowserEvent('removeFiles');

            }else{

                $nombreArchivo = null;
            }

            $incapacidad->update([
                'documento' => $nombreArchivo
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La incapacidad se actualizó con éxito."]);

        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $incapacidad = Incapacidad::find($this->selected_id);

            Storage::disk('incapacidades')->delete($incapacidad->documento);

            $incapacidad->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La incapacidad se elimino con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }




    public function render()
    {
        $incapacidades = Incapacidad::where('folio', 'LIKE', '%' . $this->search . '%')
                                        ->orWhere('documento', 'LIKE', '%' . $this->search . '%')
                                        ->orWhere('tipo', 'LIKE', '%' . $this->search . '%')
                                        ->orderBy($this->sort, $this->direction)
                                        ->paginate($this->pagination);

        $personas = Persona::all();

        return view('livewire.admin.incapacidades', compact('incapacidades', 'personas'))->extends('layouts.admin');
    }
}
