<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ListProductResource;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index(): JsonResponse
    {
        try {
            $response = $this->productService->listProduts();

            return response()->json(
                new ListProductResource($response),
                JsonResponse::HTTP_OK,
                [],
                JSON_UNESCAPED_SLASHES
            );
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        try {
            $response = $this->productService->createProduct($request);

            return response()->json(
                new ProductResource($response),
                JsonResponse::HTTP_CREATED,
                [],
                JSON_UNESCAPED_SLASHES
            );
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $response = $this->productService->findProductById($id);

            return response()->json(
                new ProductResource($response),
                JsonResponse::HTTP_OK,
                [],
                JSON_UNESCAPED_SLASHES
            );
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function update(ProductEditRequest $request, int $id): JsonResponse
    {
        try {
            $response = $this->productService->editProduct($request, $id);

            return response()->json(
                new ProductResource($response),
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            return response()->json(
                $this->productService->deleteProduct($id),
                JsonResponse::HTTP_OK,
                [],
                JSON_UNESCAPED_SLASHES
            );
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
}
