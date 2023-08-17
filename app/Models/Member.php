<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'last_name',
        'first_name',
        'card_number',
        'email',
        'phone',
        'balance',
        'admin',
        'contributor',
        'created_at',
        'class'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->where('last_name', 'like', '%'.$search.'%')
                ->orWhere('first_name', 'like', '%'.$search.'%')
                ->orWhere('card_number', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%');
        });
    }

    public function orders(){
        return $this->hasMany(Order::class, 'member_id');
    }

    public function organizationMembers(){
        return $this->hasMany(OrganizationMember::class, 'member_id');
    }

    public function challenges(){
        return $this->belongsToMany(Challenge::class, 'challenge_members', 'member_id', 'challenge_id')
            ->withPivot('comment', 'realized_at');
    }

}
