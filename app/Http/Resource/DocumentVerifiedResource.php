<?php

namespace App\Http\Resource;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Response\ApiResponse;
use App\Constant\ResponseCode;
use Illuminate\Http\JsonResponse;

class DocumentVerifiedResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "issuer" => $this->issuer,
            "result" => $this->result
        ];
    }
}
