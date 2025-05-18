<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class OrderRepository
 *
 * Репозиторий для работы с товарами.
 *
 * @package App\Repositories
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return Product::all();
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }
}
