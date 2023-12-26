<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'size',
        'organization_id',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
