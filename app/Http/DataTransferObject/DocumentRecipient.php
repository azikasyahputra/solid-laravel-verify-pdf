<?php

namespace App\Http\DataTransferObject;

use Spatie\LaravelData\Data;

class DocumentRecipient extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email
    ) {
    }
}
