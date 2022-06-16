<?php

namespace App\Http\Livewire\Admin;

use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Justificacion;
use Livewire\WithFileUploads;
use App\Http\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Storage;

class Justificaciones extends Component
{
    use WithPagination;
    use ComponentesTrait;
    use WithFileUploads;

    public $folio;
    public $documento;
    public $persona_id;

    protected function rules(){
        return [
            'folio' => 'required',
            'documento' => 'required|mimes:jpg,jpeg,png',
            'persona_id' => 'required',
         ];
    }

    protected $messages = [
        'folio.required' => 'El campo folio es requerido',
        'documento.required' => 'El campo documento es requerido',
        'documento.mimes' => 'Formato de documento inválido',
        'persona_id.required' => 'El campo empleado es requerido',
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar','crear', 'editar', 'modal', 'folio', 'documento', 'persona_id']);
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
        $this->persona_id = $modelo['persona_id'];

    }

    public function crear(){

        $this->validate();

        try {

            $justificacion = Justificacion::create([
                'folio' => $this->folio,
                'documento' => '',
                'persona_id' => $this->persona_id,
                'creado_por' => auth()->user()->id
            ]);

            if($this->documento){

                $nombredocumento = $this->documento->store('/', 'justificacion');

                $this->dispatchBrowserEvent('removeFiles');

            }else{

                $nombredocumento = null;
            }

            $justificacion->update([
                'documento' => $nombredocumento
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La justificación se creó con éxito."]);

        } catch (\Throwable $th) {
            dd($th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        $this->validate();

        try{

            $justificacion = Justificacion::find($this->selected_id);

            $justificacion->update([
                'folio' => $this->folio,
                'documento' => $this->documento,
                'persona_id' => $this->persona_id,
                'actualizado_por' => auth()->user()->id

            ]);

            if($this->documento){

                Storage::disk('justificacion')->delete($justificacion->documento);

                $nombredocumento = $this->documento->store('/', 'justificacion');

                $this->dispatchBrowserEvent('removeFiles');

            }else{

                $nombredocumento = null;
            }

            $justificacion->update([
                'documento' => $nombredocumento
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La justificación se actualizó con éxito."]);

        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }




    public function borrar(){

        try{

            $justificacion = Justificacion::find($this->selected_id);

            Storage::disk('justificacion')->delete($justificacion->documento);

            $justificacion->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La justificacion se elimino con exito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {


        $personas = Persona::all();


        $justificaciones = Justificacion::where('folio', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('persona_id', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('creado_por', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('actualizado_por', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);



        return view('livewire.admin.justificaciones', compact('justificaciones','personas'))->extends('layouts.admin');
    }
}
