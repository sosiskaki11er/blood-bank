<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class BloodBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_guid',
        'blood_type',
        'amount',
        'price'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'guid';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->guid = (string)Str::uuid();
        });
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_guid', 'guid');
    }
}
