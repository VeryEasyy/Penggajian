<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::create([
            'nama_jabatan' => 'Direktur',
            'gaji_pokok' => '15000000'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Manager',
            'gaji_pokok' => '10000000'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Supervisor',
            'gaji_pokok' => '8000000'
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Staff',
            'gaji_pokok' => '4000000'
        ]);
    }
}
