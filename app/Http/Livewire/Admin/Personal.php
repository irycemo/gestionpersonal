<?php

namespace App\Http\Livewire\Admin;

use App\Models\Horario;
use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Storage;

class Personal extends Component
{
    use WithPagination;
    use ComponentesTrait;
    use WithFileUploads;

    public $numero_empleado;
    public $nombre;
    public $paterno;
    public $materno;
    public $codigo_barras;
    public $localidad;
    public $area;
    public $tipo;
    public $rfc;
    public $curp;
    public $telefono;
    public $domicilio;
    public $email;
    public $fecha_ingreso;
    public $observaciones;
    public $horario_id;
    public $foto;
    public $status;

    protected function rules(){
        return [
            'numero_empleado' => 'required',
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'status' => 'required',
            'codigo_barras' => 'sometimes',
            'localidad' => 'required',
            'area' => 'required',
            'tipo' => 'required',
            'telefono' => 'required',
            'domicilio' => 'required',
            'email' => 'email',
            'fecha_ingreso' => 'required',
            'horario_id' => 'required',
            'foto' => 'nullable|mimes:jpg,png,jpeg',
            'rfc' => [
                        'required',
                        'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'
                    ],
            'curp' => [
                        'required',
                        'regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/i'
                    ],
         ];
    }

    protected $validationAttributes  = [
        'rfc' => 'RFC',
        'curp' => 'CURP',
        'horario_id' => 'horario',
        'paterno' => 'apellido paterno',
        'materno' => 'apellido materno',
        'telefono' => 'teléfono',
        'numero_empleado' => 'número de empleado',
        'codigo_barras' => 'código de barras',
        'area' => 'área',
    ];

    public function resetearTodo(){

        $this->reset([
            'modalBorrar',
            'foto',
            'crear',
            'editar',
            'modal',
            'numero_empleado',
            'nombre',
            'paterno',
            'materno',
            'codigo_barras',
            'localidad',
            'area',
            'tipo',
            'rfc',
            'curp',
            'telefono',
            'domicilio',
            'email',
            'fecha_ingreso',
            'observaciones',
            'horario_id'
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalEditar($modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $modelo['id'];
        $this->nombre = $modelo['nombre'];
        $this->status = $modelo['status'];
        $this->numero_empleado = $modelo['numero_empleado'];
        $this->paterno = $modelo['ap_paterno'];
        $this->materno = $modelo['ap_materno'];
        $this->codigo_barras = $modelo['codigo_barras'];
        $this->localidad = $modelo['localidad'];
        $this->area = $modelo['area'];
        $this->tipo = $modelo['tipo'];
        $this->rfc = $modelo['rfc'];
        $this->curp = $modelo['curp'];
        $this->telefono = $modelo['telefono'];
        $this->domicilio = $modelo['domicilio'];
        $this->email = $modelo['email'];
        $this->fecha_ingreso = $modelo['fecha_ingreso'];
        $this->observaciones = $modelo['observaciones'];
        $this->horario_id = $modelo['horario_id'];
        $this->foto = $modelo['foto'];

    }

    public function crear(){

        $this->validate();

        try {

            $persona = Persona::create([
                'numero_empleado' => $this->numero_empleado,
                'nombre' => $this->nombre,
                'status' => $this->status,
                'ap_paterno' => $this->paterno,
                'ap_materno' => $this->materno,
                'codigo_barras' => $this->codigo_barras,
                'localidad' => $this->localidad,
                'area' => $this->area,
                'tipo' => $this->tipo,
                'rfc' => $this->rfc,
                'curp' => $this->curp,
                'telefono' => $this->telefono,
                'domicilio' => $this->domicilio,
                'email' => $this->email,
                'fecha_ingreso' => $this->fecha_ingreso,
                'observaciones' => $this->observaciones,
                'horario_id' => $this->horario_id,
                'creado_por' => auth()->user()->id
            ]);

            if($this->foto){

                $nombreArchivo = $this->foto->store('/', 'personal');

                $this->dispatchBrowserEvent('removeFiles');

            }else{

                $nombreArchivo = null;
            }

            $persona->update([
                'foto' => $nombreArchivo
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La persona se creó con éxito."]);

        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function actualizar(){

        $this->validate();

        try{

            $persona = Persona::find($this->selected_id);

            $persona->update([
                'numero_empleado' => $this->numero_empleado,
                'nombre' => $this->nombre,
                'status' => $this->status,
                'ap_paterno' => $this->paterno,
                'ap_materno' => $this->materno,
                'codigo_barras' => $this->numero_empleado,
                'localidad' => $this->localidad,
                'area' => $this->area,
                'tipo' => $this->tipo,
                'rfc' => $this->rfc,
                'curp' => $this->curp,
                'telefono' => $this->telefono,
                'domicilio' => $this->domicilio,
                'email' => $this->email,
                'fecha_ingreso' => $this->fecha_ingreso,
                'observaciones' => $this->observaciones,
                'horario_id' => $this->horario_id,
                'actualizado_por' => auth()->user()->id
            ]);

            if($this->foto){

                if($persona->foto)
                    Storage::disk('personal')->delete($persona->foto);

                $nombreArchivo = $this->foto->store('/', 'personal');

                $this->dispatchBrowserEvent('removeFiles');

            }else{

                $nombreArchivo = null;
            }

            $persona->update([
                'foto' => $nombreArchivo
            ]);

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El permiso se actualizó con éxito."]);

        } catch (\Throwable $th) {

            dd($th);

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $persona = Persona::find($this->selected_id);

            if($persona->foto)
                Storage::disk('personal')->delete($persona->foto);

            $persona->delete();

            $this->resetearTodo();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "La persona se eliminó con éxito."]);

        } catch (\Throwable $th) {

            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function render()
    {
        $personal = Persona::where('numero_empleado', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('nombre', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('status', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('ap_paterno', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('ap_materno', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('codigo_barras', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('localidad', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('area', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('tipo', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('rfc', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('curp', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('telefono', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('domicilio', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                                ->orWhere('fecha_ingreso', 'LIKE', '%' . $this->search . '%')
                                ->orWhere(function($q){
                                    return $q->whereHas('horario', function($q){
                                        return $q->where('tipo', 'LIKE', '%' . $this->search . '%');
                                    });
                                })
                                ->orWhere('observaciones', 'LIKE', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)
                                ->paginate($this->pagination);

        $horarios = Horario::all();

        return view('livewire.admin.personal', compact('personal', 'horarios'))->extends('layouts.admin');
    }

}
