<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Persona;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RevisarChecadaSalida extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'revisar:salida';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proceso para revisar que se registre salida';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try {

            $empleados = Persona::with('checados')->where('status', 'activo')->get();

            foreach($empleados as $empleado){

                $checados = $empleado->checados()
                                        ->whereDate('created_at', Carbon::now()->today())
                                        ->get();

                if($checados->count() == 1 && $checados->first()->tipo == 'entrada'){

                    Falta::create([
                        'tipo' => 'Registro entrada y no registro salida',
                        'persona_id' => $empleado->id,
                    ]);

                }

            }

            Log::info('Proceso completado revisar que se registre salida.');

        } catch (\Throwable $th) {

            Log::error('Error en proceso para revisar que se registre salida. ' . $th);

        }

    }
}
