<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'title' => [
                'en' => $this->faker->words(3, true),
                'ar' => 'منتج ' . $this->faker->numberBetween(1, 10000),
            ],
            'description' => [
                'en' => $this->faker->paragraph(),
                'ar' => 'وصف المنتج رقم ' . $this->faker->numberBetween(1, 10000),
            ],
            'price' => $this->faker->randomFloat(2, 10, 5000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => 'products/default.png',
        ];
    }
}
