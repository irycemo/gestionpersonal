<?php

namespace Database\Factories;

use App\Models\Horario;
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
            'numero_empleado' => $this->faker->randomDigit,
            'nombre' => $this->faker->sentence(),
            'ap_paterno' => $this->faker->sentence(),
            'ap_materno' => $this->faker->sentence(),
            'codigo_barras' => $this->faker->randomDigit,
            'localidad' => $this->faker->sentence(),
            'area' => $this->faker->sentence(),
            'tipo' => $this->faker->sentence(),
            'rfc' => $this->faker->sentence(),
            'curp' => $this->faker->sentence(),
            'telefono' => $this->faker->phoneNumber,
            'domicilio' => $this->faker->sentence(),
            'email' => $this->faker->email,
            'fecha_ingreso' => $this->faker->date,
            'observaciones' => $this->faker->text(),
            'horario_id' => $this->faker->randomElement($horarios),
        ];
    }
}
