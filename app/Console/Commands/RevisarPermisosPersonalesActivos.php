<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Persona;
use Illuminate\Console\Command;

class RevisarPermisosPersonalesActivos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'revisar:permisos_activos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa los permisos que no tienen tiempo consumido debido a que el empleado no registro su regreso.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $empleados = Persona::where('status', 'activo')->get();

        foreach($empleados as $empleado){

            $permisos = $empleado->permisos()->where('tipo', 'personal')
                                            ->where('tiempo_consumido', null)
                                            ->where('status', null)
                                            ->whereDate('fecha_inicio', Carbon::yesterday()->toDateString())
                                            ->get();

            $ultimaChecada = $empleado->checados->last()->created_at->format('H:m:s');

            foreach ($permisos as $permiso) {

                $permiso->pivot->tiempo_consumido = floor((strtotime($empleado->horario->salida) - strtotime($ultimaChecada)) / 60);
                $permiso->pivot->status = 1;
                $permiso->pivot->save();

            }

        }
    }
}
