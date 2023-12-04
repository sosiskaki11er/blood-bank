<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Transfusion extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_guid',
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
            $model->guid = (string) Str::uuid();
        });
    }

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class, 'donor_guid', 'guid');
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_guid', 'guid');
    }
}
