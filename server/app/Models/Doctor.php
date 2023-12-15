<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use HasFactory, Notifiable, HasApiTokens, Authenticatable, HasRoles;

    protected $fillable = [
        'guid',
        'name',
        'surname',
        'phone',
        'email',
        'address',
        'password',
        'description',
        'hospital_guid',
        'birth'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'guid';

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string) Str::uuid();
            $model->assignRole('doctor');
        });
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_guid', 'guid');
    }

    public function donors(): HasMany
    {
        return $this->hasMany(Donor::class, 'doctor_guid', 'guid');
    }

    public function infusions(): HasMany
    {
        return $this->hasMany(Infusion::class, 'doctor_guid', 'guid');
    }
}
