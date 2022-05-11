<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Usuarios extends Component
{

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

    public function abrirModalCrear(){
        $this->modal = true;
        $this->crear =true;
    }

    public function cerrarModal(){
        $this->modal = false;
        $this->modalBorrar = false;
    }

    public function crear(){

        $usuario = User::create([
            'name' => $this->nombre,
            'email' => $this->email,
            'status' => $this->status,
            'ubicacion' => $this->ubicacion,
            'password' => 'password'
        ]);

        $usuario->roles()->attach($this->role);

        $this->modal = false;

    }

    public function actualizar(){

        $usuario = User::find($this->selected_id);

        $usuario->update([
            'name' => $this->nombre,
            'email' => $this->email,
            'status' => $this->status,
            'ubicacion' => $this->ubicacion,
        ]);

        $usuario->roles()->sync($this->role);

        $this->cerrarModal();

    }

    public function abrirModalBorrar($usuario){

        $this->modalBorrar = true;

        $this->selected_id = $usuario['id'];

    }

    public function borrar(){

        $usuario = User::find($this->selected_id);

        $usuario->delete();

        $this->cerrarModal();

    }

    public function abiriModalEditar($usuario){

        $this->modal = true;
        $this->editar = true;

        $this->selected_id = $usuario['id'];
        $this->nombre = $usuario['name'];
        $this->email = $usuario['email'];
        $this->status = $usuario['status'];
        $this->ubicacion = $usuario['ubicacion'];
        $this->role = 1;

    }

    public function render()
    {

        $usuarios = User::where('name', 'LIKE', '%' . $this->search . '%')->paginate($this->pagination);

        $roles = Role::all();

        return view('livewire.admin.usuarios', compact('usuarios', 'roles'))->extends('layouts.admin');
    }
}
