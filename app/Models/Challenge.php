<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'points',
        'description',
    ];

    public function members()
    {
        return $this->hasMany(ChallengeMember::class, 'challenge_id');
    }
}
