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
        Member::factory(100)->create();

        ProductType::factory()->create([
            'type' => 'midi',
        ]);

        ProductType::factory()->create([
            'type' => 'soiree',
        ]);

        Product::factory()->create([
            'name' => 'pizza',
            'price' => 2.5,
            'id_product_type' => ProductType::where('type', 'midi')->first()->id,
        ]);

        Product::factory()->create([
            'name' => 'nouilles',
            'price' => 1,
            'id_product_type' => ProductType::where('type', 'midi')->first()->id,
        ]);

        Product::factory()->create([
            'name' => 'meteor',
            'price' => 1.2,
            'id_product_type' => ProductType::where('type', 'soiree')->first()->id,
        ]);

        Product::factory()->create([
            'name' => 'kastel',
            'price' => 3,
            'id_product_type' => ProductType::where('type', 'soiree')->first()->id,
        ]);

        Product::factory()->create([
            'name' => 'primus',
            'price' => 1,
            'id_product_type' => ProductType::where('type', 'soiree')->first()->id,
        ]);

        Commande::factory(1000)->create();
    }
}
