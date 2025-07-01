<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'email',
        'nomor_hp',
        'verifikasi',
    ];

    public function permohonanKtps()
    {
        return $this->hasMany(PermohonanKtp::class);
    }

    public function perizinanUsahas()
    {
        return $this->hasMany(PerizinanUsaha::class);
    }
}
