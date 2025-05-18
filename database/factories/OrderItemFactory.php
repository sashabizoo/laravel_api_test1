<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory {
    /**
     * Фабрика для модели товаров внутри заказа - OrderItem.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'product_id' => 1, // временно, можно переопределять в сидере
            'order_id' => 1,
            'quantity' => rand(1, 5),
            'unit_price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
