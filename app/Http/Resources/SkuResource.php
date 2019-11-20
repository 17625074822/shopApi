<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SkuResource extends JsonResource
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
            'attr1' => $this->attr1,
            'attr2' => $this->attr2,
            'attr3' => $this->attr3,
            'quantity' => $this->quantity,
            'sort' => $this->sort,
            'status' => $this->status,
        ];
    }
}
