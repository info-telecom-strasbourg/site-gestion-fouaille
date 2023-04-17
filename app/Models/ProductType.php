<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type'
    ];

    public function products(){
        return $this->hasMany(Product::class, 'id_product_type');
    }
}
