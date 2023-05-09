<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'data' => $request
        ];
    }
}
