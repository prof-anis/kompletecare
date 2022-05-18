<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LaboratoryTestGroupResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
          "id" => $this->id,
          "name" => $this->name,
          "laboratory_tests" => $this->whenLoaded("laboratoryTests", LaboratoryTestResource::collection($this->laboratoryTests))
        ];
    }
}
