<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Retardo;
use App\Models\Permisos;
use App\Models\Incapacidad;
use App\Models\Justificacion;

class DashboardController extends Controller
{
    //

    public function __invoke()
    {

        $faltas = Falta::whereMonth('created_at', Carbon::now()->month)->count();

        $permisos = Permisos::whereMonth('created_at', Carbon::now()->month)->count();

        $retardos = Retardo::whereMonth('created_at', Carbon::now()->month)->count();

        $justificaciones = Justificacion::whereMonth('created_at', Carbon::now()->month)->count();

        $incapacidades = Incapacidad::whereMonth('created_at', Carbon::now()->month)->count();


        return view('dashboard', compact('faltas', 'permisos', 'retardos', 'justificaciones', 'incapacidades'));
    }
}
