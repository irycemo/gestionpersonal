<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Inhabil;
use App\Models\Persona;
use App\Models\Retardo;
use Livewire\Component;
use App\Http\Constantes;
use App\Models\Permisos;
use App\Models\Incidencia;
use Livewire\WithPagination;
use App\Models\Justificacion;
use App\Models\PermisoPersona;
use Illuminate\Validation\Rule;
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
    public $areas;
    public $area;
    public $empleados;
    public $empleado_id;
    public $empleado;
    public $permiso_id;
    public $permiso_limite;
    public $permiso_tiempo;
    public $permiso_descripcion;
    public $fecha_asignada;
    public $fecha_inicial;
    public $fecha_final;

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

        $this->reset('fecha_inicial', 'fecha_final');

        if($this->empleado_id != null){

            $this->empleado = Persona::select('nombre', 'ap_paterno', 'ap_materno', 'id', 'localidad')->with('permisos')->find($this->empleado_id);

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

    public function updatedArea(){

        $this->reset('empleado', 'fecha_inicial', 'fecha_final');

        $this->empleados = Persona::where('status', 'activo')
                                        ->where('area', $this->area)
                                        ->orderBy('ap_paterno')
                                        ->get();

    }

    public function convertirTiempo(){

        if($this->unidad == 'dias'){
            $this->tiempo = (int)$this->tiempo * 24;
        }

    }

    public function resetearTodo(){

        $this->reset(['fecha_asignada','fecha_inicial', 'fecha_final', 'empleado', 'area', 'tiempo', 'tipo', 'permiso_id', 'modalAsignar', 'empleado_id', 'modalBorrar', 'crear', 'editar', 'modal', 'descripcion', 'limite']);
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

        $this->resetearTodo();

        $this->permiso_id = $permiso['id'];
        $this->tipo = $permiso['tipo'];
        $this->permiso_limite = $permiso['limite'];
        $this->permiso_tiempo = $permiso['tiempo'];
        $this->permiso_descripcion = $permiso['descripcion'];

        $this->modalAsignar = true;

    }

    public function crear(){

        $this->validate();

        if($this->tipo == 'personal' && $this->tiempo >= 24){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Los permisos personales no pueden ser mayores a 24 hrs."]);

            return;

        }

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

            Log::error("Error al crear permiso por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
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

            Log::error("Error al actualizar permiso (spatie) por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
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
            Log::error("Error al borrar permiso (spatie) por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }

    }

    public function asignarPermiso(){

        $this->validate([
            'empleado' => 'required',
            'area' => 'required',
            'fecha_asignada' => [Rule::requiredIf($this->tipo == 'oficial' || $this->tipo == 'personal' && $this->empleado->localidad != 'Catastro')],
            'fecha_inicial' => [Rule::requiredIf($this->tipo == 'personal' && $this->empleado->localidad == 'Catastro')],
            'fecha_final' => [Rule::requiredIf($this->tipo == 'personal' && $this->empleado->localidad == 'Catastro')],
        ]);

        if($this->fecha_asignada){

            $permiso = PermisoPersona::where('persona_id', $this->empleado_id)
                                        ->where('fecha_inicio', '<=', Carbon::createFromFormat('Y-m-d', $this->fecha_asignada)->toDateString())
                                        ->where('fecha_final', '>=', Carbon::createFromFormat('Y-m-d', $this->fecha_asignada)->toDateString())
                                        ->first();

        }else{

            if($this->fecha_inicial > $this->fecha_final){

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "La fecha inicial no puede ser mayor a la fecha final."]);

                return;

            }

            $permiso = PermisoPersona::where('persona_id', $this->empleado_id)
                                        ->where('fecha_inicio', '<=', $this->fecha_inicial)
                                        ->where('fecha_final', '>=', $this->fecha_final)
                                        ->first();

        }

        if($permiso){

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ya tiene un permiso asignado que cobre esa fecha."]);

            $this->resetearTodo();

            return;

        }


        if($this->permiso_tiempo >= 24){

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

                $this->justificar($this->fecha_asignada, $final->format('Y-m-d'));

                PermisoPersona::create([
                    'creado_por' => auth()->user()->id,
                    'fecha_inicio' => $this->fecha_asignada,
                    'fecha_final' => $final,
                    'permisos_id' => $this->permiso_id,
                    'persona_id' => $this->empleado->id
                ]);

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "Se asigno el permiso correctamente."]);

            } catch (\Throwable $th) {

                Log::error("Error al asignar permiso: " . "id: " . $this->permiso_id . " al usuario: " . $this->empleado->id . " por: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
                $this->resetearTodo();

            }

        }else{

            try {

                if($this->tipo === 'personal' && $this->empleado->localidad === 'Catastro'){

                    $ff = Carbon::parse($this->fecha_final);
                    $fi = Carbon::parse($this->fecha_inicial);

                    PermisoPersona::create([
                        'creado_por' => auth()->user()->id,
                        'fecha_inicio' => $this->fecha_inicial,
                        'fecha_final' => $this->fecha_final,
                        'permisos_id' => $this->permiso_id,
                        'persona_id' => $this->empleado->id,
                        'tiempo_consumido' => $ff->diffInMinutes($fi)
                    ]);

                    $this->justificar($fi->format('Y-m-d'), $ff->format('Y-m-d'));

                }else{

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
                            'tiempo_consumido' => $this->tiempoConsumido()
                        ]);
                    }

                    $this->justificar($this->fecha_asignada, $this->fecha_asignada);

                }

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "Se asigno el permiso correctamente."]);

            } catch (\Throwable $th) {

                Log::error("Error al asignar permiso: " . "id: " . $this->permiso_id . " al usuario: " . $this->empleado->id . " por: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
                $this->resetearTodo();

            }

        }

        $this->resetearTodo();

    }

    public function tiempoConsumido()
    {

        $empleado = Persona::with('checados', 'horario')->where('id', $this->empleado->id)->first();

        $ultimaChecada = $empleado->checados()->whereDate('created_at', $this->fecha_asignada)->first();

        if($ultimaChecada){

            $dia = $ultimaChecada->created_at->format('l');

            $horaChecada = $ultimaChecada->created_at;

            $horaSalida = Carbon::createFromFormat('Y-m-d H:i:s', $ultimaChecada->created_at->format('Y-m-d') . ' ' . $this->obtenerDia($empleado->horario, $dia));

            if($horaSalida > $horaChecada){

                return $horaSalida->diffInMinutes($horaChecada);

            }

        }else{

            return null;

        }

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

    public function justificar($fi, $ff){

        try {

            $faltas = Falta::whereNull('justificacion_id')->where('persona_id', $this->empleado->id)->whereBetween('created_at', [$fi . ' 00:00:00', $ff . ' 23:59:59'])->get();

            $retardos = Retardo::whereNull('justificacion_id')->where('persona_id', $this->empleado->id)->whereBetween('created_at', [$fi . ' 00:00:00', $ff . ' 23:59:59'])->get();

            $incidencias = Incidencia::where('persona_id', $this->empleado->id)->whereBetween('created_at', [$fi . ' 00:00:00', $ff . ' 23:59:59'])->get();

            if($faltas->count() > 0){

                foreach ($faltas as $falta) {

                    $jus = Justificacion::latest()->orderBy('folio', 'desc')->first();

                    $jsutificacion = Justificacion::create([
                        'folio' => $jus->folio ? $jus->folio + 1 : 0,
                        'documento' => '',
                        'persona_id' => $this->empleado->id,
                        'observaciones' => "Se justifica falta mediante permiso " . $this->tipo . " " . $this->permiso_descripcion . " registrado por: " . auth()->user()->name . " con fecha de " . now()->format('d-m-Y H:i:s'),
                        'creado_por' => auth()->user()->id
                    ]);

                    $falta->update([
                        'justificacion_id' => $jsutificacion->id
                    ]);

                }

            }

            if($retardos->count() > 0){

                foreach ($retardos as $retardo) {

                    $jus = Justificacion::latest()->orderBy('folio', 'desc')->first();

                    $jsutificacion = Justificacion::create([
                        'folio' => $jus->folio ? $jus->folio + 1 : 0,
                        'documento' => '',
                        'persona_id' => $this->empleado->id,
                        'observaciones' => "Se justifica retardo mediante permiso " . $this->tipo . " " . $this->permiso_descripcion . " registrado por: " . auth()->user()->name . " con fecha de " . now()->format('d-m-Y H:i:s'),
                        'creado_por' => auth()->user()->id
                    ]);

                    $retardo->update([
                        'justificacion_id' => $jsutificacion->id
                    ]);

                }

            }

            if($incidencias->count() > 0){

                foreach ($incidencias as $incidencia) {

                    if($incidencia->tipo == 'Incidencia por checar salida antes de la hora de salida.')
                        $incidencia->delete();

                }

            }

        } catch (\Throwable $th) {

            Log::error("Error al justificar mediante permiso: " . "id: " . $this->permiso_id . " al usuario: " . $this->empleado->id . " por: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

        }

    }

    public function mount(){

        $this->areas = Constantes::AREAS_ADSCRIPCION;

    }

    public function render()
    {

        $permisos = Permisos::with('creadoPor', 'actualizadoPor')
                            ->where('descripcion','like', '%'.$this->search.'%')
                            ->orWhere('tipo','like', '%'.$this->search.'%')
                            ->orWhere('created_at','like', '%'.$this->search.'%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);


        return view('livewire.admin.permisospersonal', compact('permisos'))->extends('layouts.admin');

    }
}
