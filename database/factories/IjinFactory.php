<?php

namespace Database\Factories;

use App\Models\Ijin;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'student_id' => Student::factory(),       // Menggunakan factory untuk Student
            'user_id' => User::factory(),             // Menggunakan factory untuk User
            'reason' => $this->faker->sentence(),     // Alasan izin
            'date_pick' => $this->faker->dateTimeThisMonth(),      // Tanggal jemput
            'date_return' => $this->faker->dateTimeThisMonth(),    // Tanggal kembali
            'status' => $this->faker->randomElement(['wait_approval', 'approved', 'rejected', 'picked_up', 'returned']),
            'notes' => $this->faker->optional()->sentence(), // Catatan izin

            // Simulasi data JSON untuk lampiran dengan beberapa data acak untuk `medic`, `pickup`, dan `return`
            'attachments' => [
                'medic' => $this->faker->optional()->imageUrl(200, 200, 'medical', true, 'medic'),
                'pickup' => $this->faker->optional()->imageUrl(200, 200, 'pickup', true, 'pickup'),
                'return' => $this->faker->optional()->imageUrl(200, 200, 'return', true, 'return'),
            ],
        ];
    }
}
