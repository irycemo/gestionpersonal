<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Persona;
use App\Models\Checador;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Persona::factory(100)->create()->each(function (Persona $persona){
            Checador::factory(50)
                        ->create([
                                    'persona_id' => $persona->id
                                ]);

        });
    }
}
