<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id', 
        'tanggal_penggajian', 
        'total_tunjangan', 
        'total_potongan', 
        'gaji_bersih'
    ];
    protected $dates = ['tanggal_penggajian'];
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function jabatan()
    {
        return $this->karyawan->jabatan();
    }

    /**
     * Accessor untuk mendapatkan gaji pokok dari Jabatan Karyawan
     */
    public function getGajiPokokAttribute()
    {
        return $this->karyawan->jabatan->gaji_pokok;
    }

    /**
     * Fungsi untuk menghitung gaji bersih
     */
    public function calculateGajiBersih()
    {
        return $this->gaji_pokok + $this->total_tunjangan - $this->total_potongan;
    }

    /**
     * Accessor untuk memformat tanggal penggajian
     */
    public function getFormattedTanggalPenggajianAttribute()
    {
        return $this->tanggal_penggajian->format('d-m-Y');
    }
}
