<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, Authenticatable, HasRoles;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'password',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'guid';

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string) Str::uuid();
            $model->assignRole('admin');
        });
    }
}
