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

class Donor extends Model
{
    use HasFactory, Notifiable,HasApiTokens, Authenticatable, HasRoles;

    protected $fillable = [
        'guid',
        'name',
        'surname',
        'phone',
        'address',
        'email',
        'password',
        'doctor_guid',
        'doctors_comment',
        'blood_type',
        'blood_rh',
        'blood_disease',
        'blood_status',
        'amount_of_money',
        'birth',
    ];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'guid';
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'birth' => 'date',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string) Str::uuid();
            $model->assignRole('donor');
        });
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_guid', 'guid');
    }

    public function transfusions(): HasMany
    {
        return $this->hasMany(Transfusion::class, 'donor_guid', 'guid');
    }
}
