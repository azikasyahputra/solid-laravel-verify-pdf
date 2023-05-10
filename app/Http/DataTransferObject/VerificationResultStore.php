<?php

namespace App\Http\DataTransferObject;

use Spatie\LaravelData\Data;

class VerificationResultStore extends Data
{
    public function __construct(
        public readonly ?string $user_id,
        public readonly ?string $file_type,
        public readonly ?string $verification_result,
    ) {
    }
}
