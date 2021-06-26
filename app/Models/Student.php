<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Student
 * @package App\Models
 * @property int id
 * @property string name
 * @property string cellphone
 * @property string email
 * @property \Carbon\Carbon birth
 * @property string gender
 * @property int team_id
 */
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cellphone',
        'email',
        'birth',
        'gender',
        'team_id'
    ];

    protected $casts = [
        'name' => 'string',
        'cellphone' => 'string',
        'email' => 'string',
        'birth' => 'date',
        'gender' => 'string',
        'team_id' => 'integer'
    ];

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'student_teams', 'student_id', 'team_id');
    }
}
