<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Infusion extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_guid',
        'hospital_guid',
        'date',
        'time',
        'status',
        'amount',
        'type'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'guid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string)Str::uuid();
        });
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_guid', 'guid');
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_guid', 'guid');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_guid', 'guid');
    }
}
