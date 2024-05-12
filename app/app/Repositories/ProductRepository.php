<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interface\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /** @param array<mixed> $attributes*/
    public function create(array $attributes): Product
    {
        return Product::create($attributes);
    }

    public function findProductsByUserPaginate(int $userId, int $paginate = 10): LengthAwarePaginator
    {
        return Product::query()->where('user_id', $userId)->paginate($paginate);
    }

    public function findOnBy(string $attribute, int|string $param): ?Product
    {
        return Product::where($attribute, $param)->first();
    }
}
