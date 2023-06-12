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
        'slug',
        'price',
        'color',
        'id_product_type'
    ];

    public $with = ['productType'];

    public function productType(){
        return $this->belongsTo(ProductType::class, 'id_product_type');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'id_product');
    }
}
