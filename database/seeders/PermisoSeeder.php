<?php

namespace Database\Seeders;

use App\Models\Permisos;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permisos::create([
            'tiempo' => 24,
            'tipo' => 'oficial',

            'descripcion' => 'Día económico',
            'limite' => '12',
        ]);

        Permisos::create([
            'tiempo' => 2,
            'tipo' => 'oficial',

            'descripcion' => 'Cobro de salario',
            'limite' => '24',
        ]);

        Permisos::create([
            'tiempo' => 24,
            'tipo' => 'oficial',

            'descripcion' => 'Asambleas Sindicales',
            'limite' => '120',
        ]);

        Permisos::create([
            'tiempo' => 24,
            'tipo' => 'oficial',

            'descripcion' => 'Trámites prejubilatorios',
            'limite' => '120',
        ]);

        Permisos::create([
            'tiempo' => 24,
            'tipo' => 'personal',

            'descripcion' => 'Cumpleaños',
            'limite' => '24',
        ]);

        Permisos::create([
            'tiempo' => 2160,
            'tipo' => 'personal',

            'descripcion' => 'Permiso Paternidad o Maternidad',
            'limite' => '24',
        ]);

        Permisos::create([
            'tiempo' => 240,
            'tipo' => 'personal',

            'descripcion' => 'Permiso matrimonio',
            'limite' => '10',
        ]);

        Permisos::create([
            'tiempo' => 264,
            'tipo' => 'personal',

            'descripcion' => 'Permiso defunción',
            'limite' => '264',
        ]);
    }
}
