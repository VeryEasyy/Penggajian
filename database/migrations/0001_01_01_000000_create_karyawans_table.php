<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('jabatan_id')->constrained(
                table: 'jabatans',
                indexName: 'karyawans_jabatan_id'
            ); 
            $table->text('alamat');
            $table->date('tanggal_masuk');
            $table->string('no_telepon');
            $table->enum('status_karyawan', ['Kontrak', 'Tetap']); // Enum untuk status karyawan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
