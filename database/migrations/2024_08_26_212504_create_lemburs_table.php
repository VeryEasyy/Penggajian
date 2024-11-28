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
        Schema::create('lemburs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained(
                table: 'karyawans',
                indexName: 'lemburs_karyawan_id'
            );  
            $table->date('tanngal_lembur');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->decimal('upah_lembur', 15,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lemburs');
    }
};
