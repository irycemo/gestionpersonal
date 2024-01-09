<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Persona;
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
    protected $description = 'Calcula el tiempo consumido por los permisos personales pedidos e incidencias en el año actual';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try {

            $empleados = Persona::with('checados', 'permisos', 'incidencias')->where('status', 'activo')->get();

            foreach($empleados as $empleado){

                $permisos = $empleado->permisos()->where('tipo', 'personal')
                                                ->where('tiempo_consumido','!=', null)
                                                ->whereNull('status')
                                                ->whereYear('permisos_persona.created_at', Carbon::now()->year)
                                                ->get();

                $incidencias = $empleado->incidencias()->where('tiempo_consumido','!=', null)
                                                ->whereYear('created_at', Carbon::now()->year)
                                                ->where('status', '!=', 1)
                                                ->get();

                $min = 0;

                foreach ($permisos as $permiso) {

                    $min = $min + $permiso->pivot->tiempo_consumido;

                }

                foreach ($incidencias as $incidencia) {

                    $min = $min + $incidencia->tiempo_consumido;

                }

                if($min > 0){

                    //Horas laborales 8
                    $dias = ($min / 60) / 8;

                    if($dias >= 1){

                        /* Se asigna día económico (id: 1), al trabajador */
                        $empleado->permisos()->attach(1, ['fecha_inicio' => now()->format('Y-m-d')]);

                        $empleado->incidencias->create(['tipo' => 'Se descuenta un permiso de día económico debido al tiempo consumido por permisos personales e incidencias.', 'status' => 1]);

                        foreach($permisos as $permiso){

                            $permiso->status = 1;
                            $permiso->save();

                        }

                        foreach($incidencias as $incidencia){

                            $incidencia->status = 1;
                            $incidencia->save();

                        }

                    }

                }

            }

            Log::info('Proceso completado para calcular el tiempo consumido por los permisos e incidencias en el año actual.');

        } catch (\Throwable $th) {

            Log::error('Error en proceso para calcular tiempo consumido por los permisos. ' . $th);

        }

    }

}
