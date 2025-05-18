<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource {

    public static $wrap = null;
    
    /**
     * @OA\Schema(
     *     schema="OrderResource",
     *     type="object",
     *     title="Order Response",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="customer_name", type="string", example="Иван Иванов"),
     *     @OA\Property(property="customer_email", type="string", example="ivan@example.com"),
     *     @OA\Property(property="total_price", type="number", format="float", example=1234.56),
     *     @OA\Property(
     *         property="items",
     *         type="array",
     *         @OA\Items(
     *             @OA\Property(property="product_id", type="integer", example=3),
     *             @OA\Property(property="product_name", type="string", example="Product 3"),
     *             @OA\Property(property="quantity", type="integer", example=2),
     *             @OA\Property(property="unit_price", type="number", format="float", example=120.12),
     *         )
     *     )
     * )
     *
     * Ресурс для вывода заказа в формате JSON
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'total_price' => $this->items->sum(fn($item) => $item->unit_price * $item->quantity),
            'items' => $this->items->map(fn($item) => [
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
            ]),
        ];
    }
}
