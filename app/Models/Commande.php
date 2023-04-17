<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    public $timestamps = false; // disable timestamps columns (created_at, updated_at)

    public $with = ['product', 'member']; // eager load relationships

    protected $guarded = []; // disable mass assignment protection

    public function product(){
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'id_member');
    }
}
