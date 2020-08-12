<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "desc" => $this->desc,
            "author" => [
                "id" => $this->id,
                "name" => $this->name
            ],
            "imageUrl" => $this->imageUrl()
        ];
    }
}
