<?php

namespace App\Services;

use App\DTO\OrderDTO;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;

/**
 * Class OrderService
 *
 * Сервис бизнес-логики для работы с заказами.
 * Отвечает за создание и получение заказов, используя репозитории.
 *
 * @package App\Services
 */
class OrderService {

    /**
     * OrderService конструктор.
     *
     * @param OrderRepositoryInterface $orderRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected ProductRepositoryInterface $productRepository
        ){}

    /**
     * Создаёт новый заказ на основе DTO.
     *
     * @param OrderDTO $dto DTO с данными заказа
     * @return Order Созданный заказ с добавленными товарами
     */
    public function createOrder(OrderDTO $dto): Order {

        // Создаём заказ через репозиторий
        $order = $this->orderRepository->create([
            'customer_name' => $dto->customerName,
            'customer_email' => $dto->customerEmail,
        ]);

        // Добавляем товары к заказу
        foreach ($dto->products as $productData) {
            $product = $this->productRepository->findById($productData['product_id']);

            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $productData['quantity'],
                'unit_price' => $product->price,
            ]);
        }

        // Обновляем заказ, чтобы получить свежие данные из БД
        return $order->refresh();
    }

    /**
     * Получает заказ по его ID.
     *
     * @param int $id Идентификатор заказа
     * @return Order|null ID заказа или null, если не найден
     */
    public function getOrder(int $id): ?Order {
        return $this->orderRepository->findById($id);
    }

}
