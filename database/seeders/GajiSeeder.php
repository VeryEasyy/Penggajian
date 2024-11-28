<?php

namespace Database\Seeders;

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class GajiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua data karyawan
        $karyawans = Karyawan::all();

        // Loop melalui setiap karyawan untuk membuat data gaji
        foreach ($karyawans as $karyawan) {
            // Dapatkan gaji pokok dari relasi jabatan
            $gaji_pokok = $karyawan->jabatan->gaji_pokok;

            // Contoh nilai tunjangan dan potongan (dapat diubah sesuai kebutuhan)
            $total_tunjangan = rand(100000, 500000);
            $total_potongan = rand(50000, 100000);

            // Hitung gaji bersih
            $gaji_bersih = $gaji_pokok + $total_tunjangan - $total_potongan;

            // Simpan data gaji
            Gaji::create([
                'karyawan_id' => $karyawan->id,
                'tanggal_penggajian' => now(), // Tanggal saat ini, bisa diubah
                'total_tunjangan' => $total_tunjangan,
                'total_potongan' => $total_potongan,
                'gaji_bersih' => $gaji_bersih,
            ]);
        }
    }
}
