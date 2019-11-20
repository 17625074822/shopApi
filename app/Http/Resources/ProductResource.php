<?php

namespace App\Http\Resources;

use App\Tag;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'category_name' => $this->category->name,
            'name' => $this->name,
            'sale_num' => $this->sale_num,
            'content' => $this->content,
            'sale_num' => $this->sale_num,
            'sort' => $this->sort,
            'status' => $this->status,
            'sku' => SkuResource::collection($this->skus),
            'tag' => TagResource::collection($this->tags)
        ];
    }
}
