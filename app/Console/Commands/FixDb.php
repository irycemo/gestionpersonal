<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Persona;
use App\Models\PermisoPersona;
use Illuminate\Console\Command;

class FixDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $empleados = Persona::with('permisos', 'checados', 'horario')->where('status', 'activo')->get();

        foreach($empleados as $empleado){

            $permisos = $empleado->permisos()->where('tipo', 'personal')
                                            ->where('tiempo_consumido', null)
                                            ->where('status', null)
                                            ->whereYear('permisos_persona.created_at', now()->year)
                                            ->get();

            foreach($permisos as $permiso){

                $checadaSalida = $empleado->checados()
                                            ->whereDate('created_at', $permiso->pivot->created_at)
                                            ->where('tipo', 'salida')
                                            ->latest()
                                            ->get();

                info($checadaSalida);

                if($checadaSalida->count()){

                    $horaChecada = $checadaSalida->first()->created_at;

                    $horaSalida = Carbon::parse($horaChecada->format('Y-m-d') . $this->obtenerDia($empleado->horario));

                    info($horaChecada);

                    info($horaSalida);

                    if($horaSalida > $horaChecada){

                        $permiso->pivot->update(['tiempo_consumido' => $horaSalida->diffInMinutes($horaChecada)]);
/*
                        PermisoPersona::where('persona_id', $empleado->id)
                            ->where('permisos_id', $permiso->id)
                            ->whereDate('created_at', $permiso->pivot->created_at)
                            ->update(['tiempo_consumido' => $horaSalida->diffInMinutes($horaChecada)]);
 */
                    }

                }

            }

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
