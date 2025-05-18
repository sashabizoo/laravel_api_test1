<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Модель продукта внутри заказа.
 *
 * @property int $order_id ID заказа
 * @property int $product_id ID продукта
 * @property int $quantity Количество товара
 * @property float $unit_price Цена за единицу товара
 * @property Product $product Товар, связанный с позицией в заказе
 */
class OrderItem extends Model {
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price'];
    public $timestamps = false;

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
