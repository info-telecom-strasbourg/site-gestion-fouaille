<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::InRandomOrder()->first();

        $amount = fake()->numberBetween(1, 5);

        if(rand(0, 1) == 1){
            $signe = 1;
        }else{
            $signe = -1;
        }

        return [
            'id_product' => $product->id,
            'id_member' => Member::InRandomOrder()->first()->id,
            'price' => $signe * floatval($product->price) * $amount,
            'amount' => $amount,
            'date' => fake()->dateTimeBetween('-10 day', 'now'),
        ];
    }
}
