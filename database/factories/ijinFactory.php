<?php

namespace Database\Factories;

use App\Models\Ijin;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ijin>
 */
class IjinFactory extends Factory
{
    protected $model = Ijin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(), // Menggunakan factory untuk Student
            'user_id' => User::factory(),       // Menggunakan factory untuk User
            'class' => $this->faker->randomElement(['10', '11', '12']),
            'reason' => $this->faker->sentence(),
            'attachment_link' => $this->faker->optional()->url(),
            'medic_attachment_link' => $this->faker->optional()->url(),
            'return_attachment_link' => $this->faker->optional()->url(),
            'date_pick' => $this->faker->date(),
            'date_return' => $this->faker->date(),
            'verify_status' => $this->faker->randomElement(['0', '1']),
            'status' => $this->faker->randomElement(['0', '1']),
            'returned_at'=> $this->faker->date(),
        ];
    }
}
