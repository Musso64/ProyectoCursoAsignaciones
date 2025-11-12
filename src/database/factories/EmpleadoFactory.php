<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
        $firstPhoneDigit = $this->faker->numberBetween(100,999);
        $secondPhoneDigit = $this->faker->numberBetween(1000000,9999999);
        return [
            'fname' => $firstName,
            'sname' => $this->faker->firstName(),
            'flastname' => $lastName,
            'slastname' => $this->faker->lastName(),
            'ci' => $this->faker->unique()->numberBetween(20000000, 33000000),
            'email' => Str::lower($firstName . '.' . $lastName . '@lmagnoaudittore.com'),
            'phonenumber' => Str::lower('0'.$firstPhoneDigit.'-'.$secondPhoneDigit),
            'birthdate' => $this->faker->date($format = 'Y-m-d', $max = '2007-12-31'),
            'hiredate' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'department' => $this->faker->randomElement(['Administracion','Impuesto','IT','Marketing','Auditoria']),
            'position' => $this->faker->randomElement(['Gerente','Asistente','Senior','Socio']),
            'photo' => 'default-avatar.png'
        ];
    }
}
