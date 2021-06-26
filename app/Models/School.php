<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class School
 * @package App\Models
 * @property int id
 * @property string name
 * @property string address
 * @property \Carbon\Carbon created_at
 */
class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address'
    ];

    protected $casts = [
        'name' => 'string',
        'address' => 'string'
    ];

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

}
