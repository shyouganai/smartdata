<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
                "id" => $this->author->id,
                "name" => $this->author->name
            ],
            "imageUrl" => $this->imageUrl()
        ];
    }
}
