<?php

namespace App\DTO;

/**
 * Class OrderDTO
 *
 * DTO для передачи данных заказа.
 *
 * @package App\DTO
 */
class OrderDTO {
    public string $customerName;
    public string $customerEmail;
    public array $products;

    /**
     * @param string $customer_name
     * @param string $customer_email
     * @param array $products
     */
    public function __construct(array $data) {
        $this->customerName = $data['customer_name'];
        $this->customerEmail = $data['customer_email'];
        $this->products = $data['products'];
    }
}
