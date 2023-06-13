<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'organization_id',
        'member_id',
        'role'
    ];

    public $with = ['organization', 'member'];

    public function organization(){
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }
}
