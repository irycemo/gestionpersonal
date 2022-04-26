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
            'clave' => 'P01',
            'descripcion' => 'Permiso económico',
            'limite' => '120',
        ]);

        Permisos::create([
            'clave' => 'P02',
            'descripcion' => 'Permiso económico',
            'limite' => '288',
        ]);

        Permisos::create([
            'clave' => 'P03',
            'descripcion' => 'Permiso Oficial',
            'limite' => '0',
        ]);

        Permisos::create([
            'clave' => 'P04',
            'descripcion' => 'Permiso Sindicato',
            'limite' => '24',
        ]);

        Permisos::create([
            'clave' => 'P05',
            'descripcion' => 'Cumpleaños',
            'limite' => '24',
        ]);

        Permisos::create([
            'clave' => 'P06',
            'descripcion' => 'Permiso Paternidad o Maternidad',
            'limite' => '24',
        ]);

        Permisos::create([
            'clave' => 'P07',
            'descripcion' => 'Permiso matrimonio',
            'limite' => '240',
        ]);

        Permisos::create([
            'clave' => 'P07',
            'descripcion' => 'Permiso defunción',
            'limite' => '264',
        ]);
    }
}
