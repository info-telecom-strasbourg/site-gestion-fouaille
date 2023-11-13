<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'title',
        'price',
        'color',
        'product_type_id',
        'available'
    ];

    public $with = ['productType'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->where('products.name', 'like', '%'.$search.'%')
                ->orWhere('products.title', 'like', '%'.$search.'%')
                ->orWhere('products.price', 'like', '%'.$search.'%')
                ->orWhere('products.color', 'like', '%'.$search.'%');
        });
    }

    public function scopeOrder($query, $order_by, $order_direction){
        $query->when(isset($order_by, $order_direction), function ($query) use ($order_by, $order_direction) {
            $query
                ->when($order_by == 'type', function ($query) use ($order_direction) {
                    return $query
                        ->orderBy('product_types.type', $order_direction);
                })
                ->when(!in_array($order_by, ['type']), function ($query) use ($order_by, $order_direction) {
                    return $query->orderBy('products.'.$order_by, $order_direction);
                });
        });
    }

    public function productType(){
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'product_id');
    }
}
