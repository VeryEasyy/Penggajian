<?php

namespace Database\Factories;

use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gaji>
 */
class GajiFactory extends Factory
{
    protected $model = Gaji::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     
    public function definition(): array
    {
        // Ambil Karyawan secara acak atau buat yang baru jika tidak ada
        $karyawan = Karyawan::factory()->create();
        
        // Ambil gaji pokok dari relasi jabatan
        $gaji_pokok = $karyawan->jabatan->gaji_pokok;

        // Hitung total tunjangan dan potongan
        $total_tunjangan = $this->faker->numberBetween(1000000, 2500000);
        $total_potongan = $this->faker->numberBetween(100000, 250000);

        // Hitung gaji bersih
        $gaji_bersih = $gaji_pokok + $total_tunjangan - $total_potongan;

        return [
            'karyawan_id' => $karyawan->id,
            'tanggal_penggajian' => $this->faker->date(),
            'total_tunjangan' => $total_tunjangan,
            'total_potongan' => $total_potongan,
            'gaji_bersih' => $gaji_bersih,
        ];
    }
}
