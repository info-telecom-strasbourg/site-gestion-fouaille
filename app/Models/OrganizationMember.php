<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function organization(){
        return $this->belongsTo(Organization::class, 'id_organization');
    }
}
