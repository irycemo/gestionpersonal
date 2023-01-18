<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\ComponentesTrait;
use Livewire\Component;
use App\Models\Horario;
use Livewire\WithPagination;

class Horarios extends Component
{
    use WithPagination;
    use ComponentesTrait;

    public $descripcion;
    public $nombre;
    public $tolerancia;
    public $falta;
    public $lunes_entrada;
    public $lunes_salida;
    public $martes_entrada;
    public $martes_salida;
    public $miercoles_entrada;
    public $miercoles_salida;
    public $jueves_entrada;
    public $jueves_salida;
    public $viernes_entrada;
    public $viernes_salida;

    protected function rules(){
        return [
            'descripcion' => 'required',
            'nombre' => 'required|unique:horarios,nombre,' . $this->selected_id,
            'lunes_entrada' => 'required',
            'lunes_salida' => 'required|after:lunes_entrada',
            'martes_entrada' => 'required',
            'martes_salida' => 'required|after:martes_entrada',
            'miercoles_entrada' => 'required',
            'miercoles_salida' => 'required|after:miercoles_entrada',
            'jueves_entrada' => 'required',
            'jueves_salida' => 'required|after:jueves_entrada',
            'viernes_entrada' => 'required',
            'viernes_salida' => 'required|after:viernes_entrada',
            'tolerancia' => 'required|numeric|min:10',
            'falta' => 'required|gt:tolerancia'
         ];
    }

    protected $validationAttributes  = [
        'descripcion' => 'descripción',
        'lunes_entrada' => 'entrada',
        'lunes_salida' => 'salida',
        'martes_entrada' => 'entrada',
        'martes_salida' => 'salida',
        'miercoles_entrada' => 'entrada',
        'miercoles_salida' => 'salida',
        'jueves_entrada' => 'entrada',
        'jueves_salida' => 'salida',
        'viernes_entrada' => 'entrada',
        'viernes_salida' => 'salida',
    ];

    public function resetearTodo(){

        $this->reset([
                        'modalBorrar',
                        'crear',
                        'editar',
                        'modal',
                        'descripcion',
                        'nombre',
                        'tolerancia',
                        'falta',
                        'lunes_entrada',
                        'lunes_salida',
                        'martes_entrada',
                        'martes_salida',
                        'miercoles_entrada',
                        'miercoles_salida',
                        'jueves_entrada',
                        'jueves_salida',
                        'viernes_entrada',
                        'viernes_salida',
                    ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalEditar($horario){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $horario['id'];
        $this->descripcion = $horario['descripcion'];
        $this->nombre = $horario['nombre'];
        $this->tolerancia = $horario['tolerancia'];
        $this->falta = $horario['falta'];
        $this->lunes_entrada = $horario['lunes_entrada'];
        $this->lunes_salida = $horario['lunes_salida'];
        $this->martes_entrada = $horario['martes_entrada'];
        $this->martes_salida = $horario['martes_salida'];
        $this->miercoles_entrada = $horario['miercoles_entrada'];
        $this->miercoles_salida = $horario['miercoles_salida'];
        $this->jueves_entrada = $horario['jueves_entrada'];
        $this->jueves_salida = $horario['jueves_salida'];
        $this->viernes_entrada = $horario['viernes_entrada'];
        $this->viernes_salida = $horario['viernes_salida'];

    }

    public function crear(){

        $this->validate();

        try {

            Horario::create([
                'descripcion' => $this->descripcion,
                'nombre' => $this->nombre,
                'tolerancia' => $this->tolerancia,
                'falta' => $this->falta,
                'lunes_entrada' => $this->lunes_entrada,
                'lunes_salida' => $this->lunes_salida,
                'martes_entrada' => $this->martes_entrada,
                'martes_salida' => $this->martes_salida,
                'miercoles_entrada' => $this->miercoles_entrada,
                'miercoles_salida' => $this->miercoles_salida,
                'jueves_entrada' => $this->jueves_entrada,
                'jueves_salida' => $this->jueves_salida,
                'viernes_entrada' => $this->viernes_entrada,
                'viernes_salida' => $this->viernes_salida,
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
                'nombre' => $this->nombre,
                'tolerancia' => $this->tolerancia,
                'falta' => $this->falta,
                'lunes_entrada' => $this->lunes_entrada,
                'lunes_salida' => $this->lunes_salida,
                'martes_entrada' => $this->martes_entrada,
                'martes_salida' => $this->martes_salida,
                'miercoles_entrada' => $this->miercoles_entrada,
                'miercoles_salida' => $this->miercoles_salida,
                'jueves_entrada' => $this->jueves_entrada,
                'jueves_salida' => $this->jueves_salida,
                'viernes_entrada' => $this->viernes_entrada,
                'viernes_salida' => $this->viernes_salida,
                'actualizado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El horario se actualizó con éxito."]);

        } catch (\Throwable $th) {
            dd($th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $horario = Horario::find($this->selected_id);

            $horario->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El horario se eliminó con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }
    }

    public function render()
    {

        $horarios = horario::with('creadoPor', 'actualizadoPor')
                                ->where('descripcion', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('nombre', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('descripcion', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

       return view('livewire.admin.horarios', compact('horarios'))->extends('layouts.admin');
    }
}
