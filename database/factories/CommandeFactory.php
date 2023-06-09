<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::InRandomOrder()->first();

        $amount = fake()->numberBetween(1, 10);

        return [
            'id_product' => $product->id,
            'id_member' => Member::InRandomOrder()->first()->id,
            'price' => floatval($product->price)*$amount,
            'amount' => $amount,
            'date' => fake()->dateTimeBetween('-1 day', 'now'),
        ];
    }
}
