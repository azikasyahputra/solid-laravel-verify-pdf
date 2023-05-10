<?php

namespace App\Http\DataTransferObject;

use Spatie\LaravelData\Data;

class DocumentIssuer extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly object $identityProof
    ) {
    }
}
