<?php

namespace Database\Seeders;

use App\Models\Inhabil;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InhabilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inhabil::create([
            'anio' => '2021',
            'mes' => '5',
            'dia'=>'5',
            'descripcion' => 'Batalla de Puebla'
        ]);

        Inhabil::create([
            'anio' =>'2021',
            'mes' =>'5',
            'dia'=>'10',
            'descripcion' =>'Día de la madre'
        ]);

        Inhabil::create([
            'anio' =>'2021',
            'mes' =>'1',
            'dia'=>'1',
            'descripcion' =>'Año nuevo'
        ]);

        Inhabil::create([
            'anio' =>'2021',
            'mes' =>'12',
            'dia'=>'25',
            'descripcion' =>'Navidad'
        ]);

        Inhabil::create([
            'anio' =>'2021',
            'mes' =>'9',
            'dia'=>'16',
            'descripcion' =>'Independencia'
        ]);

        Inhabil::create([
            'anio' =>'2021',
            'mes' =>'11',
            'dia'=>'1',
            'descripcion' =>'Día de muertos'
        ]);

        Inhabil::create([
            'anio' =>'2021',
            'mes' =>'11',
            'dia'=>'2',
            'descripcion' =>'Día de muertos'
        ]);
    }
}
