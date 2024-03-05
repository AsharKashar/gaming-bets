<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MatchCollection extends BaseCollection
{
    public $collects = 'App\Http\Resources\MatchResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = null)
    {
        return parent::toArray($request);
    }
}
