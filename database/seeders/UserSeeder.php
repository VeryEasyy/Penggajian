<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat beberapa karyawan terlebih dahulu
        $karyawans = Karyawan::factory(5)->create();

        // Ambil ID dari karyawan yang pertama
        $karyawanId = $karyawans->first()->id;

        // Buat user dengan karyawan_id yang valid
        User::create([
            'karyawan_id' => $karyawanId,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'), // Hashing password
        ]);

        // Buat beberapa user lainnya
        User::factory(5)->create();

    }
}
