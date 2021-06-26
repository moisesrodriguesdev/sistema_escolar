<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Eloquent\Collection;

/**
 * Class Team
 * @package App\Models
 * @property int id
 * @property Collection students
 */
class Team extends Model
{
    use HasFactory;

    const FUNDAMENTAL = 'fundamental';
    CONST MEDIO = 'medio';

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

    /**
     * @return BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    /**
     * @return BelongsToMany
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_teams', 'team_id', 'student_id');
    }
}
