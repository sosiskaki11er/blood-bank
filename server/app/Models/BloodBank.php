<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BloodBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'blood_type',
        'amount',
    ];
    public function hospitals(): HasOne
    {
        return $this->hasOne(Hospital::class);
    }
}
