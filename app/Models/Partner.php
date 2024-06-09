<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'promo',
        'description',
        'website_link',
        'email'
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
                ->where('name', 'like', '%'.$search.'%');
        });
    }

    public function logo(){
        return $this->hasOne(PartnerLogo::class)->withDefault([
            'name' => 'default.png',
            'path' => asset('storage/images/organization_logo/default.png'),
            'size' => 0,
            'organization_id' => $this->id
        ]);
    }

}
