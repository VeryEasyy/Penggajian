<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jabatan_id', 'alamat', 'tanggal_masuk', 'no_telepon', 'status_karyawan']; 

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function gaji(): HasOne
    {
        return $this->hasOne(Gaji::class);
    }
}

