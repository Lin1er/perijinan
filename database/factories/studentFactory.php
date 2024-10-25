<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'username' => $this->faker->username(),
            'full_name' => $this->faker->name(),
            'class' => $this->faker->randomElement(['X', 'XI', 'XII']),
        ];
    }
}
