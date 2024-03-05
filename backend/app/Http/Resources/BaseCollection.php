<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request|null $request
     * @return array
     */
    public function toArray($request = null)
    {
        if(method_exists($this->resource, 'perPage')) {
            return [
                'items' => $this->collection,
                'pagination' => [
                    'per_page' => $this->resource->perPage(),
                    'page' => $this->resource->currentPage(),
                    'has_more' => $this->resource->hasMorePages(),
                    'total' => $this->resource->total()
                ],
            ];
        }

        return parent::toArray($request);
    }
}
