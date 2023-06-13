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
        'product_type_id'
    ];

    public $with = ['productType'];

    public function productType(){
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'product_id');
    }
}
