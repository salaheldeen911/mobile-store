<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public $preserveKeys = true;
    public function toArray($request)
    {
        return parent::toArray($request);

    }
}
