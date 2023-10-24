<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transfusion extends Model
{
    use HasFactory;

    public function services(): HasOne
    {
        return $this->hasOne(Service::class);
    }
}
