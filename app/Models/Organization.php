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

    public function scopeOrder($query, $order_by, $order_direction)
    {
        $query->when(isset($order_by, $order_direction), function ($query) use ($order_by, $order_direction) {
            return $query->orderBy($order_by, $order_direction);
        });
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
        });
    }

    public function members(){
        return $this->belongsToMany(Member::class, 'organization_members', 'organization_id', 'member_id')
            ->withPivot('role');
    }

    public function getLogoPath() : string {
        return asset('storage/images/organization_logo/'.$this->logo);
    }

}
