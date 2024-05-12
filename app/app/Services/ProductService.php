<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Exceptions\ProductNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(private ProductRepository $productRepository)
    {
    }


    public function listProduts(): LengthAwarePaginator
    {
        return $this->productRepository->findProductsByUserPaginate(Auth::id());
    }

    /** @return array<Product> */
    public function createProduct(ProductStoreRequest $request): array
    {
        $requestData = $request->validated();
        $requestData['user_id'] = Auth::id();

        $product = $this->productRepository->create($requestData);

        return $product->toArray();
    }

    public function findProductById(int $id): Product
    {
        $product = $this->productRepository->findOnBy('id', $id);

        if (!$product) {
            throw new ProductNotFoundException();
        }

        return $product;
    }

    /** @return array<Product> */
    public function editProduct(ProductEditRequest $request, int $id): array
    {
        $product = $this->findProductById($id);

        $product->update($request->validated());

        return $product->toArray();
    }

    /** @return array<Product> */
    public function deleteProduct(int $id): array
    {
        $product = $this->findProductById($id);

        $product->delete();

        return [
            'status'    => 'success',
            'message'   => 'Product deleted successfully.',
            'data'      => $product->toArray()
        ];
    }
}
