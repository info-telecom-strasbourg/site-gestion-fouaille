<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_organization',
        'id_member',
        'role'
    ];

    public function organization(){
        return $this->belongsTo(Organization::class, 'id_organization');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'id_member');
    }
}
