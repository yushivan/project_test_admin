<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanKtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'alamat',
        'kk',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getKkUrlAttribute()
    {
        return $this->kk ? asset('storage/' . $this->kk) : null;
    }   
}
