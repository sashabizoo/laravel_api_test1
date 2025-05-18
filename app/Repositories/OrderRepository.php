<?php

namespace App\Repositories;

use App\Models\Order;
use App\Interfaces\OrderRepositoryInterface;

/**
 * Class OrderRepository
 *
 * Репозиторий для работы с заказами.
 *
 * @package App\Repositories
 */
class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $data): Order {
        return Order::create($data);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Order {
        return Order::with(['items.product'])->find($id);
    }
}
