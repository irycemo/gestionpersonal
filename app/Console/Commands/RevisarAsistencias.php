<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Inhabil;
use App\Models\Persona;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RevisarAsistencias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'revisar:asistencias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tarea encargada de revisar los registros del la tabla checador, para generar faltas.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $inhabil = Inhabil::whereDate('fecha', '=', Carbon::yesterday()->toDateString())->first();

        if(!$inhabil){

            $empleados = Persona::select('personas.id')->leftJoin('checadors', function($q){
                                        return $q->on('personas.id', 'checadors.persona_id')
                                                    ->whereDate('checadors.created_at', '=', Carbon::yesterday()->toDateString());
                                    })
                                    ->where('status', 'activo')
                                    ->where('tipo', '!=', 'Estructura')
                                    ->where('checadors.persona_id', null)
                                    ->get();

            foreach($empleados as $empleado){

                $permiso = $empleado->permisos()
                                        ->whereDate('fecha_inicio', '<=', Carbon::yesterday()->toDateString())
                                        ->whereDate('fecha_final', '>=', Carbon::yesterday()->toDateString())
                                        ->first();

                $incapacidad = $empleado->incapacidades()
                                        ->whereDate('fecha_inicial', '<=', Carbon::yesterday()->toDateString())
                                        ->whereDate('fecha_final', '>=', Carbon::yesterday()->toDateString())
                                        ->first();

                if($permiso && $permiso->tiempo >= 24)
                    continue;

                if($incapacidad)
                    continue;

                Falta::create([
                    'tipo' => 'No se presento',
                    'persona_id' => $empleado->id
                ]);

            }

            Log::info('Proceso completo.');

        }else{

            Log::info('Día inhabil.');

        }
    }
}
