<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use  Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Nurse extends Model
{
    use HasFactory, Notifiable, HasApiTokens, AuthenticableTrait;

    protected $fillable = [
        'name',
        'password',
        'address',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'key_identifier', 'key_identifier');
    }

    public function bloodBanks(): HasMany
    {
        return $this->hasMany(BloodBank::class, 'key_identifier', 'key_identifier');
    }

    public function hospital_heads(): BelongsTo
    {
        return $this->belongsTo(HospitalHead::class, 'hospital_head_id', 'guid');
    }
}
