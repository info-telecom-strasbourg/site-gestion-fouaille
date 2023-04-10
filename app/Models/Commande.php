<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    public $timestamps = false;


    public function products(){
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'id_member');
    }
}
