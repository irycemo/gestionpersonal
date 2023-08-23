<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Checador>
 */
class ChecadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $date = Carbon::today()->subMonths(1)->startOfMonth()->addDays(rand(1,30))->addHours(8)->addHour(rand(1,8))->addMinutes(rand(1,50));

        $persona_id = Persona::inRandomOrder()->first()->id;

        return [
            'hora' => $date,
            'tipo' => ['entrada', 'salida'][array_rand(['entrada', 'salida'])],
            'persona_id' => $persona_id,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
