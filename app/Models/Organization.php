<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'short_name',
        'description',
        'website_link',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'discord_link',
        'logo_link',
        'email',
        'association'
    ];

    public function members(){
        return $this->hasMany(OrganizationMember::class, 'organization_id');
    }

    public function getLogoPath() : string {
        return asset('storage/images/organization_logo/'.$this->logo);
    }

}
