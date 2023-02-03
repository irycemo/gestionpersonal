<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Persona;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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

        try {

            $empleados = Persona::with('permisos', 'checados', 'horario')->where('status', 'activo')->get();

            foreach($empleados as $empleado){

                $permisos = $empleado->permisos()->where('tipo', 'personal')
                                                ->where('tiempo_consumido', null)
                                                ->where('status', null)
                                                ->whereDate('fecha_inicio', Carbon::yesterday()->toDateString())
                                                ->get();

                if($empleado->checados->count()){

                    $ultimaChecada = $empleado->checados->last()->created_at->format('H:i:s');

                    foreach ($permisos as $permiso) {

                        $permiso->pivot->tiempo_consumido = floor((strtotime($this->obtenerDia($empleado->horario)) - strtotime($ultimaChecada)) / 60);
                        $permiso->pivot->status = 1;
                        $permiso->pivot->save();

                    }

                }

            }

            Log::info('Proceso completo para calcular tiempo consumido por permisos sin checada de regrso.');

        } catch (\Throwable $th) {

            Log::error('Error en proceso para calcular tiempo consumido por permisos sin checada de regrso. ' . $th->getMessage());

        }

    }

    public function obtenerDia($horario){

        $a =  [
            'Monday' => 'lunes_salida',
            'Tuesday' => 'martes_salida',
            'Wednesday' => 'miercoles_salida',
            'Thursday' => 'jueves_salida',
            'Friday' => 'viernes_salida'
        ][now()->format('l')];

        return $horario[$a];

    }
}
