<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoHabitacionesResource extends JsonResource
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
            'id_tipo_habitacion' => $this->id_tipo_habitacion,
            "tipo" => $this->tipo,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
