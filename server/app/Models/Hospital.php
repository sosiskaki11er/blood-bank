<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hospital extends Model
{
    use HasFactory;

    /**
     * @var mixed|string
     */

    protected $fillable = [
        'guid',
        'name',
        'head_id',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function hospitalHead(): BelongsTo
    {
        return $this->belongsTo(HospitalHead::class, 'head_id', 'guid');
    }
}
