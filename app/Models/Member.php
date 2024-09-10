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

    public function challenges(){
        return $this->belongsToMany(Challenge::class, 'challenge_members', 'member_id', 'challenge_id')
            ->withPivot('comment', 'realized_at');
    }

    public function getHasCategory($category){
        $challenge_tab = $this->challenges()->where('category', $category)->count();
        
        if ($challenge_tab >= 4) {
            return true;
        }

        return false;
    }

    public function getCategorycount(){

        $total_categories = 0;

        for ($i=0; $i<5; $i++) {
            if ($this->getHasCategory($i)) {
                $total_categories ++;
            }
        }  

        return $total_categories;
    }

    public function getPointscount(){

        if ($this->challenges()->count() == 0) {
            return 0;
        }

        $challenge_tab = $this->challenges()->get()->toArray();
        $total_points = $this->challenges()->count() + $this->getCategorycount() * 1000;

        for ($i=1; $i<5; $i++) {
            if ($this->getHasCategory($i)) {
               $total_points += $i*100;
            }
        }  

        return $total_points;
    }

}
