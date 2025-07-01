<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerizinanUsaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'nama_usaha',
        'bidang_usaha',
        'alamat_usaha',
        'ktp',
        'npwp',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getKtpUrlAttribute()
    {
        return $this->ktp ? asset('storage/' . $this->ktp) : null;
    }

    public function getNpwpUrlAttribute()
    {
        return $this->npwp ? asset('storage/' . $this->npwp) : null;
    }

}
