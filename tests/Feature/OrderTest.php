<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order(): void
    {
        Product::factory()->create(['id' => 889, 'name' => 'Product 1', 'price' => 100.00]);
        Product::factory()->create(['id' => 890, 'name' => 'Product 2', 'price' => 110.00]);

        $payload = [
            'customer_name' => 'Test',
            'customer_email' => 'test@test.com',
            'products' => [
                ['product_id' => 889, 'quantity' => 1],
                ['product_id' => 890, 'quantity' => 2],
            ]
        ];

        $response = $this->postJson('/api/orders', $payload);
        $response->assertStatus(201)
            ->assertJsonStructure([            
                'id',
                'customer_name',
                'customer_email',
                'total_price',
                'items' => [
                    [
                        'product_id',
                        'product_name',
                        'quantity',
                        'unit_price',
                    ]
                ]
            ]);
    }

    public function test_get_order(): void
    {
        $this->test_create_order();
        $orderId = 1;

        $response = $this->getJson("/api/orders/{$orderId}");
        $response->assertStatus(200)
            ->assertJsonFragment(['customer_name' => 'Test']);
    }
}
