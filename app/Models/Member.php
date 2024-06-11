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
        'class',
        'birth_date',
        'sector'
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

    public function scopeOrder($query, $order_by, $order_direction)
    {
        $query->when(isset($order_by, $order_direction), function ($query) use ($order_by, $order_direction) {
            $query
                ->when($order_by == 'name', function ($query) use ($order_direction) {
                    return $query
                        ->orderBy('last_name', $order_direction)
                        ->orderBy('first_name', $order_direction);
                })
                ->when(!in_array($order_by, ['name']), function ($query) use ($order_by, $order_direction) {
                    return $query->orderBy($order_by, $order_direction);
                });
        });
    }

    public function orders(){
        return $this->hasMany(Order::class, 'member_id');
    }

    public function organizations(){
        return $this->belongsToMany(Organization::class, 'organization_members', 'member_id', 'organization_id')
            ->withPivot('role');
    }

    public function InOrganization($organization_id){
        return $this->organizations->contains($organization_id);
    }

    public function challenges(){
        return $this->belongsToMany(Challenge::class, 'challenge_members', 'member_id', 'challenge_id')
            ->withPivot('comment', 'realized_at');
    }

}
