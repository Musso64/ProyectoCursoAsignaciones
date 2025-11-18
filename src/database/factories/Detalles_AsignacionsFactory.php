<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detalles_Asignacions>
 */
class Detalles_AsignacionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "assignation_name" => $this->faker->sentence(6),
            "description" => $this->faker->paragraph(4),
            "assigned_date" => $this->faker->dateTimeBetween('-6 months','today'),
            "due_date" => $this->faker->dateTimeBetween('+15 days','+1 year'),
            "status" => $this->faker->randomElement(['Pendiente','En progreso','Completada','Cancelada'])
        ];
    }
}
