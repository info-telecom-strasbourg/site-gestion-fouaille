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
        'price',
        'product_type'
    ];

    public function productType(){
        return $this->belongsTo(ProductType::class, 'product_type');
    }

    public function commandes(){
        return $this->hasMany(Commande::class, 'id_product');
    }
}
