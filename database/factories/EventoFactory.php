<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence(3),
            'descripcion' => $this->faker->text(200), // Limita a 200 caracteres
            'fecha' => $this->faker->dateTimeBetween('-10 days', '+30 days'),
        ];
    }
}
