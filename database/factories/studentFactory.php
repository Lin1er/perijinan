<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'student_class_id' => StudentClass::inRandomOrder()->first()->id,
            'username' => $this->faker->userName(),
            'name' => $this->faker->name(),
        ];
    }
}
