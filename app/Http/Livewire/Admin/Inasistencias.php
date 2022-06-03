<?php
namespace App\Http\Livewire\Admin;


use Carbon\Carbon;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Inasistencia;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Storage;


class Inasistencias extends Component
{

    use WithPagination;
    use ComponentesTrait;
    use WithFileUploads;

    public $motivo;
    public $fecha;
    public $archivo;
    public $persona_id;

    protected function rules(){
        return [
            'motivo' => 'required',
            'fecha' => 'required',
            'archivo' => 'required|mimes:jpg,jpeg,png',
            'persona_id' => 'required',
         ];
    }

    protected $messages = [
        'motivo.required' => 'El campo motivo es requerido',
        'fecha.required' => 'El campo fecha es requerido',
        'archivo.required' => 'El campo archivo es requerido',
        'archivo.mimes' => 'Formato de archivo inválido',
        'persona_id.required' => 'El campo empleado es requerido',
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar','crear', 'editar', 'modal', 'motivo', 'fecha','archivo', 'persona_id']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abiriModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->motivo = $modelo['motivo'];
        $this->fecha = Carbon::createFromFormat('Y-m-d H:i:s', $modelo['fecha'])->format('Y-m-d');
        $this->archivo = $modelo['archivo'];
        $this->persona_id = $modelo['persona_id'];

    }

    public function crear(){

        $this->validate();

        try {

            $inasistencia = Inasistencia::create([
                'motivo' => $this->motivo,
                'fecha' => $this->fecha,
                'persona_id' => $this->persona_id,
                'creado_por' => auth()->user()->id
            ]);

            if($this->archivo){

                $nombreArchivo = $this->archivo->store('/', 'inasistencias');

                $this->dispatchBrowserEvent('removeFiles');

            }else{

                $nombreArchivo = null;
            }

            $inasistencia->update([
                'archivo' => $nombreArchivo
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La inasistencia se creó con éxito."]);

        } catch (\Throwable $th) {
            dd($th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        $this->validate();

        try{

            $inasistencia = Inasistencia::find($this->selected_id);

            $inasistencia->update([
                'motivo' => $this->motivo,
                'fecha' => $this->fecha,
                'archivo' => $this->archivo,
                'persona_id' => $this->persona_id,
                'actualizado_por' => auth()->user()->id

            ]);

            if($this->archivo){

                Storage::disk('inasistencias')->delete($inasistencia->archivo);

                $nombreArchivo = $this->archivo->store('/', 'inasistencias');

                $this->dispatchBrowserEvent('removeFiles');

            }else{

                $nombreArchivo = null;
            }

            $inasistencia->update([
                'archivo' => $nombreArchivo
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La inasistencia se  actualizó con éxito."]);

        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }




    public function borrar(){

        try{

            $inasistencia = Inasistencia::find($this->selected_id);

            Storage::disk('inasistencias')->delete($inasistencia->archivo);

            $inasistencia->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La inasistencia se elimino con exito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {


        $personas = Persona::all();


        $inasistencias = Inasistencia::where('motivo', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('fecha', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('archivo', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('persona_id', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('creado_por', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('actualizado_por', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);



        return view('livewire.admin.inasistencias', compact('inasistencias','personas'))->extends('layouts.admin');
    }
}



