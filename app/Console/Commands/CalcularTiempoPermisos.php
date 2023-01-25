<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Persona;
use App\Models\Permisos;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CalcularTiempoPermisos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calcular:tiempo_permisos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calcula el tiempo consumido por los permisos personales pedidos en el mes actual';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try {

            $empleados = Persona::where('status', 'activo')->get();

            foreach($empleados as $empleado){

                $permisos = $empleado->permisos()->where('tipo', 'personal')
                                                ->where('tiempo_consumido','!=', null)
                                                ->where('status', '!=', null)
                                                ->whereMonth('permisos_persona.created_at', Carbon::now()->month)
                                                ->get();

                $min = 0;

                foreach ($permisos as $permiso) {

                    $min = $min + $permiso->pivot->tiempo_consumido;

                }

                //Horas laborales 8
                $dias = ($min / 60) / 8;

                if($dias >= 1){

                    $diaEconomico = Permisos::where('descripcion', 'Permiso económico')->first();

                    $empleado->permisos()->attach($diaEconomico->id, ['fecha_inicio' => now()->format('Y-m-d')]);

                }

            }

            Log::info('Proceso completado para calcular el tiempo consumido por los permisos en el mes actual.');

        } catch (\Throwable $th) {

            Log::error('Error en proceso para calcular tiempo consumido por los permisos. ' . $th->getMessage());

        }

    }

}
