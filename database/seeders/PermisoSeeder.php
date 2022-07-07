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
            'clave' => 'P01',
            'descripcion' => 'Permiso económico',
            'limite' => '12',
        ]);

        Permisos::create([
            'tiempo' => 2,
            'tipo' => 'oficial',
            'clave' => 'P01',
            'descripcion' => 'Cobro de salario',
            'limite' => '24',
        ]);

        Permisos::create([
            'tiempo' => 24,
            'tipo' => 'oficial',
            'clave' => 'P01',
            'descripcion' => 'Asambleas Sindicales',
            'limite' => '120',
        ]);

        Permisos::create([
            'tiempo' => 24,
            'tipo' => 'oficial',
            'clave' => 'P01',
            'descripcion' => 'Trámites prejubilatorios',
            'limite' => '120',
        ]);

        Permisos::create([
            'tiempo' => 24,
            'tipo' => 'personal',
            'clave' => 'P05',
            'descripcion' => 'Cumpleaños',
            'limite' => '24',
        ]);

        Permisos::create([
            'tiempo' => 2160,
            'tipo' => 'personal',
            'clave' => 'P06',
            'descripcion' => 'Permiso Paternidad o Maternidad',
            'limite' => '24',
        ]);

        Permisos::create([
            'tiempo' => 240,
            'tipo' => 'personal',
            'clave' => 'P07',
            'descripcion' => 'Permiso matrimonio',
            'limite' => '10',
        ]);

        Permisos::create([
            'tiempo' => 264,
            'tipo' => 'personal',
            'clave' => 'P07',
            'descripcion' => 'Permiso defunción',
            'limite' => '264',
        ]);
    }
}
