<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jabatan>
 */
class JabatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_jabatan' => $this->faker->word, // Atau bisa menggunakan nilai yang relevan
            'gaji_pokok' => $this->faker->numberBetween(1000000, 15000000), // Sesuaikan jika perlu
        ];
    }
}