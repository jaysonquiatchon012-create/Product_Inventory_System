<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'product_code' => fake()->unique()->numerify('PRD###'),
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 50, 5000),
            'quantity' => fake()->numberBetween(1, 100),
            'category_id' => 1,
        ];
    }
}