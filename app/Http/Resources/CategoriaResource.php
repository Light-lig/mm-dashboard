<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'cat_id' => $this->cat_id,
            "cat_tipo" => $this->cat_tipo,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
