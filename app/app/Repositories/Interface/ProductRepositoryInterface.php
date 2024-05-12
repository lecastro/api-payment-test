<?php

declare(strict_types=1);

namespace App\Repositories\Interface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model as AbstractModel;

interface ProductRepositoryInterface
{
    /**
     * @param array<mixed> $attributes
     */
    public function create(array $attributes): AbstractModel;

    public function findProductsByUserPaginate(int $userId, int $paginate = 10): LengthAwarePaginator;

    /** @param Collection<Product> */
    public function findOnBy(string $attribute, int|string $param): null|AbstractModel;
}
