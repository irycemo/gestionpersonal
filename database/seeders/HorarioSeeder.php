<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::create([
            'falta' => 30,
            'nombre' => 'Normal',
            'lunes_entrada' => '09:00:00',
            'lunes_salida' => '15:00:00',
            'martes_entrada' => '09:00:00',
            'martes_salida' => '15:00:00',
            'miercoles_entrada' => '09:00:00',
            'miercoles_salida' => '15:00:00',
            'jueves_entrada' => '09:00:00',
            'jueves_salida' => '15:00:00',
            'viernes_entrada' => '09:00:00',
            'viernes_salida' => '15:00:00',
            'creado_por' => 1,
            'tolerancia'=>'15'
        ]);

        Horario::create([
            'falta' => 30,
            'nombre' => 'Compensación',
            'lunes_entrada' => '09:00:00',
            'lunes_salida' => '17:00:00',
            'martes_entrada' => '09:00:00',
            'martes_salida' => '17:00:00',
            'miercoles_entrada' => '09:00:00',
            'miercoles_salida' => '17:00:00',
            'jueves_entrada' => '09:00:00',
            'jueves_salida' => '17:00:00',
            'viernes_entrada' => '09:00:00',
            'viernes_salida' => '17:00:00',
            'creado_por' => 1,
            'tolerancia'=>'15'
        ]);
    }
}
