<?php

namespace App\Http\DataTransferObject;

use Spatie\LaravelData\Data;

class DocumentData extends Data
{
    public function __construct(
        public readonly object $data,
        public readonly object $signature
    ) {
    }
}
