<?php

namespace App\Http\Resources;

use App\Http\Resources\Category as CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Note extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'note' => $this->note,
            'category' => new CategoryResource($this->category),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}