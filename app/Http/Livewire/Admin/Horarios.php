<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\ComponentesTrait;
use Livewire\Component;
use App\Models\Horario;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;


class Horarios extends Component
{
    use WithPagination;
    use ComponentesTrait;

    public $descripcion;
    public $tipo;
    public $entrada;
    public $salida;
    public $tolerancia;
    public $entrada_mixta;
    public $salida_mixta;
    public $tolerancia_mixta;

    protected function rules(){
        return [
            'descripcion' => 'required',
            'tipo' => 'required',
            'entrada' => 'required',
            'salida' => 'required|after:entrada',
            'tolerancia' => 'required',
            'entrada_mixta' => 'nullable|after:salida',
            'salida_mixta' => 'nullable|required_with:entrada_mixta|after:entrada_mixta',
         ];
    }

    protected $messages = [
    ];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'descripcion', 'tipo', 'entrada', 'salida','tolerancia','entrada_mixta','salida_mixta','tolerancia_mixta']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalEditar($horario){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $horario['id'];
        $this->descripcion = $horario['descripcion'];
        $this->tipo = $horario['tipo'];
        $this->entrada = $horario['entrada'];
        $this->salida = $horario['salida'];
        $this->tolerancia = $horario['tolerancia'];
        $this->entrada_mixta = $horario['entrada_mixta'];
        $this->salida_mixta = $horario['salida_mixta'];
        $this->tolerancia_mixta = $horario['tolerancia_mixta'];
    }


    public function crear(){

        $this->validate();

        try {

            $horario = Horario::create([
                'descripcion' => $this->descripcion,
                'tipo' => $this->tipo,
                'entrada' => $this->entrada,
                'salida' => $this->salida,
                'tolerancia' => $this->tolerancia,
                'entrada_mixta' => $this->entrada_mixta,
                'salida_mixta' => $this->salida_mixta,
                'tolerancia_mixta' => $this->tolerancia_mixta,
                'creado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El horario se creó con éxito."]);

        } catch (\Throwable $th) {
            dd($th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }
    }

    public function actualizar(){

        $this->validate();

        try{

            $horario = Horario::find($this->selected_id);

            $horario->update([
                'descripcion' => $this->descripcion,
                'tipo' => $this->tipo,
                'entrada' => $this->entrada,
                'salida' => $this->salida,
                'tolerancia' => $this->tolerancia,
                'entrada_mixta' => $this->entrada_mixta,
                'salida_mixta' => $this->salida_mixta,
                'tolerancia_mixta' => $this->tolerancia_mixta,
                'actualizado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El horario se actualizó con éxito."]);

        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $horario = Horario::find($this->selected_id);

            $horario->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El horario se eliminó con exito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }
    }

    public function render()
    {

        $horarios = horario::with('creadoPor', 'actualizadoPor')
                                ->where('descripcion', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('tipo', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('entrada', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('salida', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

       return view('livewire.admin.horarios', compact('horarios'))->extends('layouts.admin');
    }
}
