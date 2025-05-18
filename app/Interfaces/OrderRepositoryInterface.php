<?php

namespace App\Interfaces;

use App\Models\Order;

interface OrderRepositoryInterface {

    /**
     * Новый заказ
     *
     * @param array $data
     * @return Order
     */
    public function create(array $data): Order;

    /**
     * Найти заказ по ID
     *
     * @param int $id
     * @return Order|null
     */
    public function findById(int $id): ?Order;
}
