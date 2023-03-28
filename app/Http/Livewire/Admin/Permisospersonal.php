<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Inhabil;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Permisos;
use Livewire\WithPagination;
use App\Models\PermisoPersona;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\ComponentesTrait;

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

            Log::error("Error al crear permiso por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
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

            Log::error("Error al actualizar permiso (spatie) por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
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
            Log::error("Error al borrar permiso (spatie) por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function asignarPermiso(){

        /* Si el permiso es de salida ($this->permiso_tiempo == 0) la fecha asignada no puede ser mayor a el día actual */
        if($this->permiso_tiempo == 0){

            $this->validate([
                'fecha_asignada' => 'sometimes|date|before:tomorrow',
                'empleado_id' => 'required',
            ]);

        }else{

            $this->validate([
                'fecha_asignada' => 'sometimes|date',
                'empleado_id' => 'required',
            ]);

        }

        $permiso = PermisoPersona::where('persona_id', $this->empleado_id)
                                        ->where('fecha_inicio', '<=', Carbon::createFromFormat('Y-m-d', $this->fecha_asignada)->toDateString())
                                        ->where('fecha_final', '>=', Carbon::createFromFormat('Y-m-d', $this->fecha_asignada)->toDateString())
                                        ->first();

        if($permiso){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ya tiene un permiso asignado que cobre esa fecha."]);

            $this->resetearTodo();

            return;

        }


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

                /* $this->empleado->permisos()->attach($this->permiso_id, [
                    'creado_por' => auth()->user()->id,
                    'fecha_inicio' => $this->fecha_asignada,
                    'fecha_final' => $final
                ]); */

                PermisoPersona::create([
                    'creado_por' => auth()->user()->id,
                    'fecha_inicio' => $this->fecha_asignada,
                    'fecha_final' => $final,
                    'permisos_id' => $this->permiso_id,
                    'persona_id' => $this->empleado->id
                ]);

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "Se asigno el permiso correctamente."]);

            } catch (\Throwable $th) {

                Log::error("Error al asignar permiso: " . "id: " . $this->permiso_id . " al usuario: " . $this->empleado->id . " por: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
                $this->resetearTodo();

            }

        }else{

            try {/*

                $this->empleado->permisos()->attach($this->permiso_id, [
                    'creado_por' => auth()->user()->id,
                    'fecha_inicio' => $this->fecha_asignada,
                    'fecha_final' => $this->fecha_asignada
                ]); */

                if(now()->isSameDay($this->fecha_asignada)){

                    PermisoPersona::create([
                        'creado_por' => auth()->user()->id,
                        'fecha_inicio' => $this->fecha_asignada,
                        'fecha_final' => $this->fecha_asignada,
                        'permisos_id' => $this->permiso_id,
                        'persona_id' => $this->empleado->id
                    ]);

                }else{

                    PermisoPersona::create([
                        'creado_por' => auth()->user()->id,
                        'fecha_inicio' => $this->fecha_asignada,
                        'fecha_final' => $this->fecha_asignada,
                        'permisos_id' => $this->permiso_id,
                        'persona_id' => $this->empleado->id,
                        'status' => 1,
                        'tiempo_consumido' => $this->tiempoConsumido()
                    ]);
                }

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "Se asigno el permiso correctamente."]);

            } catch (\Throwable $th) {

                Log::error("Error al asignar permiso: " . "id: " . $this->permiso_id . " al usuario: " . $this->empleado->id . " por: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th->getMessage());
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
                $this->resetearTodo();

            }

        }

        $this->resetearTodo();

    }

    public function tiempoConsumido()
    {

        $empleado = Persona::with('checados', 'horario')->where('id', $this->empleado->id)->first();

        $ultimaChecada = $empleado->checados()->whereDate('created_at', '=',$this->fecha_asignada)->where('tipo', 'salida')->first()->created_at->format('H:i:s');

        $dia = $empleado->checados()->whereDate('created_at', '=',$this->fecha_asignada)->where('tipo', 'salida')->first()->created_at->format('l');

        $tiempo_consumido = floor((strtotime($this->obtenerDia($empleado->horario, $dia)) - strtotime($ultimaChecada)) / 60);

        return $tiempo_consumido;

    }

    public function obtenerDia($horario, $dia){

        $a =  [
            'Monday' => 'lunes_salida',
            'Tuesday' => 'martes_salida',
            'Wednesday' => 'miercoles_salida',
            'Thursday' => 'jueves_salida',
            'Friday' => 'viernes_salida'
        ][$dia];

        return $horario[$a];

    }

    public function render()
    {

        $empleados = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id')->orderBy('nombre')->get();

        $permisos = Permisos::with('creadoPor', 'actualizadoPor')
                            ->where('descripcion','like', '%'.$this->search.'%')
                            ->orWhere('tipo','like', '%'.$this->search.'%')
                            ->orWhere('created_at','like', '%'.$this->search.'%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);


        return view('livewire.admin.permisospersonal', compact('permisos', 'empleados'))->extends('layouts.admin');
    }
}
