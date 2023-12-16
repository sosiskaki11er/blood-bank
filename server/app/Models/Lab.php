<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Lab extends User
{
    use HasFactory, Notifiable, HasApiTokens, AuthenticableTrait, HasRoles;

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

    public function hospital_heads(): BelongsTo
    {
        return $this->belongsTo(HospitalHead::class, 'hospital_head_id', 'guid');
    }

    public function users(): MorphOne
    {
        return $this->morphOne(User::class, 'profile');
    }
}
