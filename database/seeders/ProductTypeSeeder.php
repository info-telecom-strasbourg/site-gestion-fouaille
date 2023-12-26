<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductType::create([
            'type' => 'soirée'
        ]);

        ProductType::create([
            'type' => 'afterwork'
        ]);

        ProductType::create([
            'type' => 'midi'
        ]);

        ProductType::create([
            'type' => 'gouter'
        ]);

        ProductType::create([
            'type' => 'oenologie'
        ]);
    }
}
