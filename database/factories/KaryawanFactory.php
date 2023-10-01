<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->unique()->randomNumber(3, true),
            'nama_lengkap' =>  fake()->name(),
            'jabatan' => fake()->randomElement(['MKT', 'IT', 'HRD']),
            'no_hp' => fake()->phoneNumber(),
            'kode_dept' => fake()->randomElement(['MKT', 'IT', 'HRD']),
            'password' => bcrypt('12345')
        ];
    }
}
