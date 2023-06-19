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

    public function orders(){
        return $this->hasMany(Order::class, 'member_id');
    }

    public function organizationMembers(){
        return $this->hasMany(OrganizationMember::class, 'member_id');
    }

}
