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
        'nickname',
        'card_number',
        'email',
        'phone_number',
        'balance',
        'admin',
        'contributor',
        'created_at',
        'class'
    ];

    public function orders(){
        return $this->hasMany(Order::class, 'id_member');
    }

    public function organizationMembers(){
        return $this->hasMany(OrganizationMember::class, 'id_member');
    }

}
