<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class HospitalHead extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

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


}
