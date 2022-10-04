<?php

namespace Database\Factories;

use App\Models\Horario;
use App\Http\Constantes;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $horarios = Horario::pluck('id');

        return [
            'numero_empleado' => $this->faker->unique()->randomNumber,
            'nombre' => $this->faker->name,
            'ap_paterno' => $this->faker->word,
            'ap_materno' => $this->faker->word,
            'codigo_barras' => $this->faker->unique()->randomNumber,
            'localidad' => Arr::random(Constantes::LOCALIDADES),
            'area' => Arr::random(Constantes::AREAS_ADSCRIPCION),
            'tipo' => Arr::random(Constantes::TIPO),
            'rfc' => $this->faker->sentence(),
            'curp' => $this->faker->sentence(),
            'telefono' => $this->faker->phoneNumber,
            'domicilio' => $this->faker->text(),
            'email' => $this->faker->unique()->email,
            'fecha_ingreso' => $this->faker->date,
            'observaciones' => $this->faker->text(),
            'horario_id' => $this->faker->randomElement($horarios),
            'status' => 'activo'
        ];
    }
}
