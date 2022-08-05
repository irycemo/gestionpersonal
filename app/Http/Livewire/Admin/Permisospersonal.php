<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Permisos;
use Livewire\WithPagination;
use App\Http\Traits\ComponentesTrait;
use App\Models\Inhabil;

class Permisospersonal extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public $descripcion;
    public $limite;
    public $tipo;
    public $tiempo;
    public $unidad;

    public $modalAsignar = false;
    public $empleado_id;
    public $empleado;
    public $permiso_id;
    public $permiso_limite;
    public $permiso_tiempo;
    public $fecha_asignada;

    protected $queryString = ['search'];

    protected function rules(){
        return [
            'descripcion' => 'required',
            'limite' => 'required',
            'tipo' => 'required',
            'tiempo' => 'required',
         ];
    }

    protected $messages = [
        'descripcion.required' => 'El campo descripción es obligatorio.',
        'limite.required' =>'El campo límite es obligatorio.',
        'empleado_id.required' =>'El campo empleado es obligatorio.',
        'fecha_asignada.required' =>'El campo fecha es obligatorio.',
        'fecha_asignada.date' =>'El campo fecha es inválido.',
        'fecha_asignada.after' =>'El campo fecha debe ser igual o mayor a hoy.'
    ];

    public function updatedEmpleadoId(){

        if($this->empleado_id != null){

            $this->empleado = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->with('permisos')->find($this->empleado_id);

            $permisosSolicitados = $this->empleado->permisos()->where('permisos_id', $this->permiso_id)
                                                                ->whereMonth('permisos.created_at', Carbon::now()->month)
                                                                ->count();

            if($permisosSolicitados >= $this->permiso_limite){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "El empleado ya ha superado el límite de permisos permitidos este mes."]);

                $this->resetearTodo();
            }

        }

    }

    public function updatedFechaAsignada(){

        $inhabil = Inhabil::whereDate('fecha', $this->fecha_asignada)->first();

        if($inhabil){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "La fecha es día inhabil: " . $inhabil->descripcion . ', seleccione otra fecha.']);

            $this->reset('fecha_asignada');

        }

    }

    public function convertirTiempo(){

        if($this->unidad == 'dias'){
            $this->tiempo = (int)$this->tiempo * 24;
        }

    }

    public function resetearTodo(){

        $this->reset(['fecha_asignada', 'tiempo', 'tipo', 'permiso_id', 'modalAsignar', 'empleado_id', 'modalBorrar', 'crear', 'editar', 'modal', 'descripcion', 'limite']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abiriModalEditar($permisospersonal){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;
        $this->selected_id = $permisospersonal['id'];

        $this->tipo = $permisospersonal['tipo'];
        $this->descripcion = $permisospersonal['descripcion'];
        $this->limite = $permisospersonal['limite'];

        if($permisospersonal['tiempo'] > 24){
            $this->tiempo = $permisospersonal['tiempo'] / 24;
            $this->unidad = "dias";
        }
        else
            $this->tiempo = $permisospersonal['tiempo'];

    }

    public function abiriModalAsignar($permiso){

        $this->permiso_id = $permiso['id'];
        $this->permiso_limite = $permiso['limite'];
        $this->permiso_tiempo = $permiso['tiempo'];

        if($this->permiso_tiempo == 0)
            $this->fecha_asignada = now()->format('Y-m-d');

        $this->modalAsignar = true;

    }

    public function crear(){

        $this->validate();

        $this->convertirTiempo();

        try {

            Permisos::create([
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
        }

    }

    public function actualizar(){

        $this->validate();

        $this->convertirTiempo();

        try{

            $permiso = Permisos::find($this->selected_id);

            $permiso->update([
                'tipo'=> $this->tipo,
                'tiempo'=> $this->tiempo,
                'descripcion' => $this->descripcion,
                'limite' => $this->limite,
                'actualizado_por' => auth()->user()->id
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se actualizó con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function borrar(){

        try{

            $permiso = Permisos::find($this->selected_id);

            $permiso->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se eliminó con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function asignarPermiso(){

        $this->validate([
            'fecha_asignada' => 'sometimes|date|after:yesterday',
            'empleado_id' => 'required',
        ]);

        if($this->permiso_tiempo > 24){



            $dias = $this->permiso_tiempo / 24;

            $final = Carbon::createFromFormat('Y-m-d', $this->fecha_asignada);

            for ($i=0; $i < $dias; $i++) {

                $final->addDay();

                $inhabil = Inhabil::whereDate('fecha', $final->format('Y-m-d'))->first();

                while($inhabil != null){

                    $final->addDay();
                    $inhabil = Inhabil::whereDate('fecha', $final->format('Y-m-d'))->first();

                }

                while($final->isWeekend()){

                    $final->addDay();

                }

            }

            try {

                $this->empleado->permisos()->attach($this->permiso_id, [
                    'creado_por' => auth()->user()->id,
                    'fecha_inicio' => $this->fecha_asignada,
                    'fecha_final' => $final
                ]);

            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
                $this->resetearTodo();
            }

        }else{



            try {

                $this->empleado->permisos()->attach($this->permiso_id, [
                    'creado_por' => auth()->user()->id,
                    'fecha_inicio' => $this->fecha_asignada,
                    'fecha_final' => $this->fecha_asignada
                ]);

            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
                $this->resetearTodo();
            }

        }

        $this->resetearTodo();

    }

    public function render()
    {

        $empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        $permisos = Permisos::Where('descripcion','like', '%'.$this->search.'%')
                            ->orWhere('tipo','like', '%'.$this->search.'%')
                            ->orWhere('created_at','like', '%'.$this->search.'%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);


        return view('livewire.admin.permisospersonal', compact('permisos', 'empleados'))->extends('layouts.admin');
    }
}
