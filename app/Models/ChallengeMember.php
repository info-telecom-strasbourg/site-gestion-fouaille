<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeMember extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'challenge_id',
        'member_id',
        'comment',
    ];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
