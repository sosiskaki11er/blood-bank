<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use  Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class HospitalHead extends Model implements Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, AuthenticableTrait;

    protected $fillable = [
        'key_identifier',
        'name',
        'password',
        'address',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function hospitals(): HasMany
    {
        return $this->hasMany(Hospital::class, 'head_id', 'guid');
    }
}
