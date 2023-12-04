<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Hospital extends Model
{
    use HasFactory;

    /**
     * @var mixed|string
     */
    protected $fillable = [
        'guid',
        'name',
        'address',
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
            $model->guid = (string) Str::uuid();
            $model->createBloodBanks($model->guid);
        });
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class, 'hospital_guid', 'guid');
    }

    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class, 'hospital_guid', 'guid');
    }

    public function transfusions(): HasMany
    {
        return $this->hasMany(Transfusion::class, 'hospital_guid', 'guid');
    }

    public function bloodBanks(): HasMany
    {
        return $this->hasMany(BloodBank::class, 'hospital_guid', 'guid');
    }

    public function createBloodBanks($hospital_guid): void
    {
        //create blood banks
        $bloodTypes = [
            'A+',
            'A-',
            'B+',
            'B-',
            'O+',
            'O-',
            'AB+',
            'AB-'
        ];
        foreach ($bloodTypes as $bloodType) {
            BloodBank::create([
                'hospital_guid' => $hospital_guid,
                'blood_type' => $bloodType,
            ]);
        }
    }
}
