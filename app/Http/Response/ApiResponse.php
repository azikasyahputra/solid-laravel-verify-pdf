<?php

namespace App\Http\Response;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiResponse implements Responsable
{
    /**
     * @param mixed $data
     * @param array $metadata
     * @param int $code
     * @param array $headers
     */
    public function __construct(
        private mixed $data,
        private int $code = Response::HTTP_OK,
    ) {
    }

    /**
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            [
                'data' => $this->data,
            ],
            $this->code,
        );
    }
}
