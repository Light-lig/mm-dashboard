<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TypeUserResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        /* return [
            "usr_id" => $this->usr_id,
            "usr_correo" => $this->usr_correo,
            "tusr_id" => $this->tusr_id,
            "tusr_tipo_usuario" => new TypeUserResource(
                $this->tusr_tipo_usuario
            ),
        ]; */
    }
}
