<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Usuarios extends Component
{

    use WithPagination;

    public $modal = false;
    public $modalBorrar = false;
    public $crear = false;
    public $editar = false;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $pagination=10;
    public $selected_id;

    public $nombre;
    public $email;
    public $status;
    public $role;
    public $ubicacion;

    protected function rules(){
        return [
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->selected_id,
            'status' => 'required|in:activo,inactivo',
            'role' => 'required',
            'ubicacion' => 'required',
         ];
    }

    protected $messages = [
        'nombre.required' => 'El campo nombre es requerido',
    ];

    public function order($sort){

        if($this->sort == $sort){
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function updatedPagination(){
        $this->resetPage();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'nombre', 'email', 'status', 'role', 'ubicacion']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function abrirModalBorrar($model){

        $this->modalBorrar = true;

        $this->selected_id = $model['id'];

    }

    public function abrirModalCrear(){
        $this->resetearTodo();
        $this->modal = true;
        $this->crear =true;
    }

    public function abiriModalEditar($usuario){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $usuario['id'];
        $this->nombre = $usuario['name'];
        $this->email = $usuario['email'];
        $this->status = $usuario['status'];
        $this->ubicacion = $usuario['ubicacion'];
        $this->role = 1;

    }

    public function crear(){

        $this->validate();

        try {

            $usuario = User::create([
                'name' => $this->nombre,
                'email' => $this->email,
                'status' => $this->status,
                'ubicacion' => $this->ubicacion,
                'password' => 'sistema'
            ]);

            $usuario->roles()->attach($this->role);

            $this->cerrarModal();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El usuario se creó con éxito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->cerrarModal();
            $this->resetearTodo();
        }

    }

    public function actualizar(){

        try{

            $usuario = User::find($this->selected_id);

            $usuario->update([
                'name' => $this->nombre,
                'email' => $this->email,
                'status' => $this->status,
                'ubicacion' => $this->ubicacion,
            ]);

            $usuario->roles()->sync($this->role);

            $this->cerrarModal();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El usuario se actualizó con éxito."]);

        } catch (\Throwable $th) {
            ;
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->cerrarModal();
            $this->resetearTodo();
        }

    }

    public function borrar(){

        try{

            $usuario = User::find($this->selected_id);

            $usuario->delete();

            $this->cerrarModal();

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "El usuario se elimino con exito."]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->cerrarModal();
            $this->resetearTodo();
        }

    }

    public function render()
    {

        $usuarios = User::where('name', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('ubicacion', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('status', 'LIKE', '%' . $this->search . '%')
                            ->orWhere(function($q){
                                return $q->whereHas('roles', function($q){
                                    return $q->where('name', 'LIKE', '%' . $this->search . '%');
                                });
                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        $roles = Role::all();

        return view('livewire.admin.usuarios', compact('usuarios', 'roles'))->extends('layouts.admin');
    }
}
