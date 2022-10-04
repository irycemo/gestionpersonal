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
            'entrada' => 9,
            'salida' => 15,
            'creado_por' => 1,
            'tolerancia'=>'15'
        ]);

        Horario::create([
            'falta' => 30,
            'Tipo' => 'Compensación',
            'entrada' => 9,
            'salida' => 17,
            'creado_por' => 1,
            'tolerancia'=>'15'
        ]);
    }
}
