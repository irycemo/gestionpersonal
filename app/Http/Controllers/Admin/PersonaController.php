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
        $persona->load('faltas.justificacion', 'retardos.justificacion', 'justificaciones.retardo', 'justificaciones.falta', 'justificaciones.creadoPor', 'justificaciones.actualizadoPor', 'incapacidades.creadoPor', 'incapacidades.actualizadoPor');

        return view('admin.personal.show', compact('persona'));
    }
}
