<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'guid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string)Str::uuid();
        });
    }
}
