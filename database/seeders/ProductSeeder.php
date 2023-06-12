<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->create([
            'name' => 'cocktail12',
            'slug' => 'cocktail12',
            'price' => 1.2,
            'id_product_type' => ProductType::where('type', 'Soirée')->first()->id,
            'color' => fake()->hexColor()
        ]);

        Product::factory()->create([
            'name' => 'cocktail16',
            'slug' => 'cocktail16',
            'price' => 1.6,
            'id_product_type' => ProductType::where('type', 'Soirée')->first()->id,
            'color' => fake()->hexColor()
        ]);

        Product::factory()->create([
            'name' => 'meteor',
            'slug' => 'meteor',
            'price' => 1.2,
            'id_product_type' => ProductType::where('type', 'Soirée')->first()->id,
            'color' => fake()->hexColor()
        ]);

        Product::factory()->create([
            'name' => 'pizza',
            'slug' => 'pizza',
            'price' => 2.6,
            'id_product_type' => ProductType::where('type', 'Midi')->first()->id,
            'color' => fake()->hexColor()
        ]);


        Product::factory()->create([
            'name' => 'sandwich',
            'slug' => 'sandwich',
            'price' => 2,
            'id_product_type' => ProductType::where('type', 'Midi')->first()->id,
            'color' => fake()->hexColor()
        ]);

        Product::factory()->create([
            'name' => 'charcuterie',
            'slug' => 'charcuterie',
            'price' => 4.4,
            'id_product_type' => ProductType::where('type', 'CharcutFromage')->first()->id,
            'color' => fake()->hexColor()
        ]);

        Product::factory()->create([
            'name' => 'fromage',
            'slug' => 'fromage',
            'price' => 3,
            'id_product_type' => ProductType::where('type', 'CharcutFromage')->first()->id,
            'color' => fake()->hexColor()
        ]);

        Product::factory()->create([
            'name' => 'bordeaux',
            'slug' => 'bordeaux',
            'price' => 1.6,
            'id_product_type' => ProductType::where('type', 'Oeno')->first()->id,
            'color' => fake()->hexColor()
        ]);

        Product::factory()->create([
            'name' => 'cookies',
            'slug' => 'cookies',
            'price' => 2.2,
            'id_product_type' => ProductType::where('type', 'Goûter')->first()->id,
            'color' => fake()->hexColor()
        ]);

        Product::factory()->create([
            'name' => 'metre',
            'slug' => 'metre',
            'price' => 1.2,
            'id_product_type' => ProductType::where('type', 'Shots')->first()->id,
            'color' => fake()->hexColor()
        ]);
    }
}
