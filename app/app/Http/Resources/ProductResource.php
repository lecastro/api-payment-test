<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        return ['data' => $this->formatResource($data)];
    }

    /**
     * @param array<string> $data
     * @return array<string>
     */
    private function formatResource(array $data): array
    {
        return [
            'id'        => data_get($data, 'id'),
            'name'      => data_get($data, 'name'),
            'detail'    => data_get($data, 'detail'),
            'createdAt' => data_get($data, 'created_at'),
            'updatedAt' => data_get($data, 'updated_at'),
            'deletedAt' => data_get($data, 'deleted_at'),
        ];
    }
}
