<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Commande;
use App\Models\Member;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Member::factory(30)->create();

        ProductType::factory(3)->create();

        Product::factory(10)->create();

        Commande::factory(100)->create();
    }
}
