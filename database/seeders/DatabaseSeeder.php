<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Сидер базы данных.
     *
     * Создаёт тестовые продукты и заказы с привязкой order_items.
     */
    public function run(): void {
        //User::factory(10)->create();

        Product::factory(5)->create();

        $products = Product::all();

        Order::factory(5)->create()->each(function ($order) use ($products) {

            $items = $products->random(rand(1, 3))->mapWithKeys(function ($product) {
                return [
                    $product->id => [
                        'quantity' => rand(1, 5),
                        'unit_price' => $product->price,
                    ],
                ];
            });
            $order->products()->attach($items);
        });

    }
}
