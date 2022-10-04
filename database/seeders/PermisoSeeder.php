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
            'limite' => '10',
        ]);

        Permisos::create([
            'tiempo' => 24,
            'tipo' => 'oficial',
            'descripcion' => 'Trámites prejubilatorios',
            'limite' => '5',
        ]);

        Permisos::create([
            'tiempo' => 24,
            'tipo' => 'oficial',
            'descripcion' => 'Cumpleaños',
            'limite' => '10',
        ]);

        Permisos::create([
            'tiempo' => 2160,
            'tipo' => 'oficial',
            'descripcion' => 'Permiso Paternidad o Maternidad',
            'limite' => '24',
        ]);

        Permisos::create([
            'tiempo' => 240,
            'tipo' => 'oficial',
            'descripcion' => 'Permiso matrimonio',
            'limite' => '2',
        ]);

        Permisos::create([
            'tiempo' => 264,
            'tipo' => 'oficial',
            'descripcion' => 'Permiso defunción',
            'limite' => '2',
        ]);

        Permisos::create([
            'tiempo' => 0,
            'tipo' => 'personal',
            'descripcion' => 'Permiso de salida',
            'limite' => '2',
        ]);
    }
}
