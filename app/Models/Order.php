<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false; // disable timestamps columns (created_at, updated_at)

    public $with = ['product', 'member']; // eager load relationships


    protected $guarded = []; // disable mass assignment protection

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->where('products.name', 'like', '%'.$search.'%')
                ->orWhere('members.last_name', 'like', '%'.$search.'%')
                ->orWhere('members.first_name', 'like', '%'.$search.'%')
                ->orWhere('products.name', 'like', '%'.$search.'%')
                ->orWhere('product_types.type', 'like', '%'.$search.'%')
                ->orWhere('orders.price', 'like', '%'.$search.'%')
                ->orWhere('orders.amount', 'like', '%'.$search.'%');
        });
    }

    public function scopeOrder($query, $order_by, $order_direction)
    {
        $query->when(isset($order_by, $order_direction), function ($query) use ($order_by, $order_direction) {
            $query
                ->when($order_by == 'product', function ($query) use ($order_direction) {
                    return $query
                        ->orderBy('products.name', $order_direction);
                })
                ->when($order_by == 'type', function ($query) use ($order_direction) {
                    return $query
                        ->orderBy('product_types.type', $order_direction);
                })
                ->when($order_by == 'name', function ($query) use ($order_direction) {
                    return $query
                        ->orderBy('members.last_name', $order_direction);
                })
                ->when(!in_array($order_by, ['product', 'type', 'name']), function ($query) use ($order_by, $order_direction) {
                    return $query->orderBy('orders.'.$order_by, $order_direction);
                });
        });
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }

}
