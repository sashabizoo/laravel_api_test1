<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 *
 * Модель заказа.
 *
 * @package App\Models
 *
 * @property int $id ID заказа
 * @property string $customer_name Имя заказчика
 * @property string $customer_email Email заказчика
 * @property \Illuminate\Support\Collection $items Товары в заказе
 */
class Order extends Model {
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['customer_name', 'customer_email'];

    public function items(): HasMany {
        return $this->hasMany(OrderItem::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot(['quantity', 'unit_price'])
            ->withTimestamps();
    }


}
