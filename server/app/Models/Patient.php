<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Model
{
    use HasFactory, Notifiable, Authenticatable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'address',
        'email',
        'password',
        'description',
        'birth',
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

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string) Str::uuid();
            $model->assignRole('patient');
        });
    }

    public function doctors(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function transfusions(): HasMany
    {
        return $this->hasMany(Transfusion::class, 'patient_guid', 'guid');
    }
}
