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
        Product::create([
            'name' => 'primus demis',
            'title' => 'primus D',
            'price' => 1.4,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 1
        ]);

        Product::create([
            'name' => 'primus pinte',
            'title' => 'pinte P',
            'price' => 2.8,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 1
        ]);

        Product::create([
            'name' => 'charlesquint demis',
            'title' => 'charlesquint D',
            'price' => 1.6,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 1
        ]);

        Product::create([
            'name' => 'charlesquint pinte',
            'title' => 'charlesquint P',
            'price' => 3.2,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 1
        ]);

        Product::create([
            'name' => 'jupiler demis',
            'title' => 'jupiler D',
            'price' => 1.2,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 1
        ]);

        Product::create([
            'name' => 'jupiler pinte',
            'title' => 'jupiler P',
            'price' => 2.4,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 1
        ]);

        Product::create([
            'name' => 'cidre',
            'title' => 'cidre',
            'price' => 2,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 2
        ]);

        Product::create([
            'name' => 'repas',
            'title' => 'repas',
            'price' => 1,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 3
        ]);

        Product::create([
            'name' => 'desert',
            'title' => 'desert',
            'price' => 0.5,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 3
        ]);

        Product::create([
            'name' => 'bordeaux',
            'title' => 'bordeaux',
            'price' => 1.6,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 5
        ]);

        Product::create([
            'name' => 'bourgogne',
            'title' => 'bourgogne',
            'price' => 1.8,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 5
        ]);

        Product::create([
            'name' => 'champagne',
            'title' => 'champagne',
            'price' => 2,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 5
        ]);

        Product::create([
            'name' => 'cookies',
            'title' => 'cookies',
            'price' => 1.1,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 4
        ]);

        Product::create([
            'name' => 'brownies',
            'title' => 'brownies',
            'price' => 1.2,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 4
        ]);

        Product::create([
            'name' => 'muffins',
            'title' => 'muffins',
            'price' => 1.3,
            'available' => 1,
            'color' => fake()->hexColor(),
            'product_type_id' => 4
        ]);
    }
}
