<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    use HasFactory;

    const FUNDAMENTAL = 'fundamental';
    CONST MEDIO = 'MEDIO';

    protected $fillable = [
        'year',
        'teach_level',
        'serie',
        'shift',
        'school_id',
    ];

    protected $casts = [
        'year' => 'integer',
        'teach_level' => 'string',
        'serie' => 'integer',
        'shift' => 'string',
        'school_id' => 'integer',
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
