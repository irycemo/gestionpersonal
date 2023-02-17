<?php

namespace App\Http\Controllers\Admin;

use App\Models\Persona;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{
    public function __invoke(Persona $persona)
    {
        $persona->load(
            'faltas.justificacion',
            'retardos.justificacion',
            'justificaciones.retardo',
            'justificaciones.falta',
            'justificaciones.creadoPor',
            'justificaciones.actualizadoPor',
            'incapacidades.creadoPor',
            'incapacidades.actualizadoPor',
            'permisos2.permiso',
            'permisos2.creadoPor'
        );

        return view('admin.personal.show', compact('persona'));
    }
}
