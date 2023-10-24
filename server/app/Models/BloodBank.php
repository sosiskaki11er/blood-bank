<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BloodBank extends Model
{
    use HasFactory;

    public function hospitals(): HasOne
    {
        return $this->hasOne(Hospital::class);
    }
}
