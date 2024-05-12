<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        $dataFormated = [];

        foreach (data_get($data, 'data') as $value) {
            $dataFormated[] = $this->formatResource($value);
        }

        return [
            'current_page'      => data_get($data, 'current_page'),
            'data'              => $dataFormated,
            'first_page_url'    => data_get($data, 'first_page_url'),
            'from'              => data_get($data, 'from'),
            'last_page'         => data_get($data, 'last_page'),
            'last_page_url'     => data_get($data, 'last_page_url'),
            'links'             => data_get($data, 'links'),
            'next_page_url'     => data_get($data, 'next_page_url'),
            'path'              => data_get($data, 'path'),
            'per_page'          => data_get($data, 'per_page'),
            'prev_page_url'     => data_get($data, 'prev_page_url'),
            'to'                => data_get($data, 'to'),
            'total'             => data_get($data, 'total'),
        ];
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
