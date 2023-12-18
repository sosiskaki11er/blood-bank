<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Staff extends Model
{
    use HasFactory, Notifiable, HasApiTokens, Authenticatable, HasRoles;

    protected $fillable = [
        'guid',
        'name',
        'surname',
        'phone',
        'address',
        'email',
        'password',
        'description',
        'birth',
        'hospital_guid',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'guid';

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'birth' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string) Str::uuid();
            $model->assignRole('staff');
        });
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_guid', 'guid');
    }
}
