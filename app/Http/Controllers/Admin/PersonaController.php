<?php

namespace App\Http\Controllers\Admin;

use App\Models\Falta;
use App\Models\Persona;
use App\Models\Retardo;
use App\Models\Incapacidad;
use App\Models\Inasistencia;
use App\Models\Justificacion;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{
    public function __invoke(Persona $persona)
    {
        return view('admin.personal.show', compact('persona'));
    }
}
