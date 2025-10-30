<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'nomor_telepon' => '08' . fake()->numerify('##########'), // Generate 081234567890 format
            'tanggal_lahir' => fake()->date('Y-m-d', '2000-01-01'),
            'alamat' => fake()->address(),
            'tanggal_masuk' => fake()->dateTimeBetween('2020-01-01', 'now')->format('Y-m-d'),
            'status' => fake()->randomElement(['aktif', 'nonaktif']),
        ];
    }
}
