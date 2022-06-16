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
            'Tipo' => 'Normal',
            'entrada' => 8,
            'salida' => 15,
            'creado_por' => 1,
            'tolerancia'=>'1'
        ]);

        Horario::create([
            'falta' => 30,
            'Tipo' => 'Compensación',
            'entrada' => 8,
            'salida' => 17,
            'creado_por' => 1,
            'tolerancia'=>'1'
        ]);

        Horario::create([
            'falta' => 30,
            'Tipo' => 'Normal',
            'entrada' => 8,
            'salida' => 15,
            'creado_por' => 1,
            'tolerancia'=>'1'
        ]);

        Horario::create([
            'falta' => 30,
            'Tipo' => 'Intendencia',
            'entrada' => 7,
            'salida' => 13,
            'creado_por' => 1,
            'tolerancia'=>'1'
        ]);

        Horario::create([
            'falta' => 30,
            'Tipo' => 'Intendencia 2',
            'entrada' => 7,
            'salida' => 13.5,
            'creado_por' => 1,
            'tolerancia'=>'1'
        ]);

        Horario::create([
            'falta' => 30,
            'Tipo' => 'Intendencia 3',
            'entrada' => 7,
            'salida' => 14,
            'creado_por' => 1,
            'tolerancia'=>'1'
        ]);
    }
}
