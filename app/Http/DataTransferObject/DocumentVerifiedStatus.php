<?php

namespace App\Http\DataTransferObject;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

class DocumentVerifiedStatus extends Data
{
    public function __construct(
        public readonly string $issuer,
        public readonly string $result
    ) {
    }
}
