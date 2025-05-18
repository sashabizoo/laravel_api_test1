<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface {

    /**
     * Получить все товары
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Найти товар по ID
     *
     * @param int $id
     * @return Product|null
     */
    public function findById(int $id): ?Product;
}
