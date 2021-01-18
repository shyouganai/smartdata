<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            "bio" => $this->bio,
            "image" => $this->image ? $this->imageUrl() : null,
            "birth_date" => $this->birth_date,
            "died_date" => $this->died_date,
        ];
    }
}
