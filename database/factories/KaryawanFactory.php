<?php

namespace Database\Factories;

use App\Models\Jabatan;
use App\Models\User;
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
            'nama' => fake()->name(),
            'jabatan_id' => Jabatan::factory(),
            'alamat' => fake()->text(),
            'tanggal_masuk' => fake()->date(),
            'no_telepon' => fake()->sentence(),
            'status_karyawan' => $this->faker->randomElement(['Kontrak', 'Tetap']),
        ];
    }
}
