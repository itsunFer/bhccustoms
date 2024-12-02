<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class gimnastaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre_g' => $this->nombre_g,
            'apellido_g' => $this->apellido_g,
            'fecha_n_g' => $this->fecha_n_g,
            'paises_id' => $this->paises_id,
        ];
    }
}
