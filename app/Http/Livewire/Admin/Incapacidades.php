<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Incapacidad;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Storage;

class Incapacidades extends Component
{
    use WithPagination;
    use WithFileUploads;
    use ComponentesTrait;

    public $documento;
    public $tipo;
    public $persona;
    public $imagen;
    public $fecha_inicial;
    public $fecha_final;
    public $observaciones;

    protected $queryString = ['search'];

    protected function rules(){
        return [
            'documento' => 'nullable|mimes:jpg,png,jpeg',
            'tipo' => 'required',
            'persona' => 'required',
            /* 'fecha_inicial' => 'required|date|after:yesterday', */
            'fecha_inicial' => 'required|date',
            'fecha_final' => 'required|date|after:fecha_inicial|after:fecha_inicial'
         ];
    }

    protected $validationAttributes  = [
        'fecha_inicial' => 'fecha inicial',
        'fecha_final' => 'fecha final',
        'persona' => 'empleado',
    ];

    protected $messages = [
        'fecha_inicial.after' => 'El campo fecha inicial debe ser una fecha posterior al día de ayer.'
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal','documento', 'tipo', 'persona', 'imagen', 'fecha_inicial', 'fecha_final', 'observaciones']);
        $this->resetErrorBag();
        $this->resetValidation();

        $this->dispatchBrowserEvent('removeFiles');
    }

    public function abiriModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->tipo = $modelo['tipo'];
        $this->observaciones = $modelo['observaciones'];
        $this->fecha_inicial = Carbon::createFromFormat('d-m-Y', $modelo['fecha_inicial'])->format('Y-m-d');
        $this->fecha_final = Carbon::createFromFormat('d-m-Y', $modelo['fecha_final'])->format('Y-m-d');
        $this->persona = $modelo['persona_id'];
        $this->imagen = Storage::disk('incapacidades')->url($modelo['documento']);

    }

    public function crear(){

        $this->validate();

        $incapacidad = Incapacidad::where('persona_id', $this->persona)->where('fecha_inicial', '<=', Carbon::createFromFormat('Y-m-d', $this->fecha_inicial))->where('fecha_final', '>=', Carbon::createFromFormat('Y-m-d', $this->fecha_inicial))->first();

        if($incapacidad){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ya tiene una incapacidad asignada que cobre esa fecha."]);

            $this->resetearTodo();

            return;

        }

        try {

            DB::transaction(function () {

                $folio = Incapacidad::orderBy('folio', 'desc')->value('folio');

                $incapacidad = Incapacidad::create([
                    'folio' =>  $folio ? $folio + 1 : 1,
                    'tipo' => $this->tipo,
                    'fecha_inicial' => $this->fecha_inicial,
                    'fecha_final' => $this->fecha_final,
                    'persona_id' => $this->persona,
                    'observaciones' => $this->observaciones,
                    'creado_por' => auth()->user()->id
                ]);

                if($this->documento){

                    $nombreArchivo = $this->documento->store('/', 'incapacidades');

                    $this->dispatchBrowserEvent('removeFiles');

                    $incapacidad->update([
                        'documento' => $nombreArchivo
                    ]);

                }

                $this->resetearTodo();

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La incapacidad se creó con éxito."]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al crear incapacidad por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        $this->validate();

        try{

            DB::transaction(function () {

                $incapacidad = Incapacidad::find($this->selected_id);

                $incapacidad->update([
                    'tipo' => $this->tipo,
                    'fecha_inicial' => $this->fecha_inicial,
                    'fecha_final' => $this->fecha_final,
                    'persona_id' => $this->persona,
                    'observaciones' => $this->observaciones,
                    'actualizado_por' => auth()->user()->id
                ]);

                if($this->documento){

                    Storage::disk('incapacidades')->delete($incapacidad->documento);

                    $nombreArchivo = $this->documento->store('/', 'incapacidades');

                    $this->dispatchBrowserEvent('removeFiles');

                    $incapacidad->update([
                        'documento' => $nombreArchivo
                    ]);

                }

                $this->resetearTodo();

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La incapacidad se actualizó con éxito."]);

            });

        } catch (\Throwable $th) {

            Log::error("Error al actualizar incapacidad por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
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

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La incapacidad se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar incapacidad por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {
        $incapacidades = Incapacidad::with('persona', 'creadoPor', 'actualizadoPor')
                                        ->where('folio', 'LIKE', '%' . $this->search . '%')
                                        ->orWhere('documento', 'LIKE', '%' . $this->search . '%')
                                        ->orWhere('tipo', 'LIKE', '%' . $this->search . '%')
                                        ->orWhere('created_at','like', '%'.$this->search.'%')
                                        ->orderBy($this->sort, $this->direction)
                                        ->paginate($this->pagination);

        $personas = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->where('status', 'activo')->orderBy('nombre')->get();

        return view('livewire.admin.incapacidades', compact('incapacidades', 'personas'))->extends('layouts.admin');
    }
}
