<?php

namespace App\Console\Commands;

use App\Models\Persona;
use App\Models\Incidencia;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RevisarHoraDeChecadoDeSalidas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'revisar:incidencias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proceso para calcular los minutos de diferencia entre la hora de checada de salida cuando es menos a la hora de salida establecida';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try {

            $empleados = Persona::with('ultimoChecado', 'horario')->where('status', 'activo')->get();

            foreach($empleados as $empleado){

                if($empleado->ultimoChecado && $empleado->ultimoChecado->created_at->isToday() && $empleado->ultimoChecado->tipo == 'salida'){

                    $horaSalida = strtotime($this->obtenerDia($empleado->horario));

                    $horaChecada = strtotime($empleado->ultimoChecado->created_at->format('H:i:s'));

                    if($horaChecada < $horaSalida){

                        $min = $horaChecada - $horaSalida;

                        Incidencia::create([
                            'tipo' => 'Incidencia por checar salida antes de la hora de salida.',
                            'persona_id' => $empleado->id,
                            'status' => 1,
                            'tiempo_consumido' => $min
                        ]);

                    }

                }

            }

            Log::info('Proceso completado para revisar la hora de checada de salida contra la hora de salida.');

        } catch (\Throwable $th) {

            Log::error('Error en proceso para revisar horas de salida. ' . $th);

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
