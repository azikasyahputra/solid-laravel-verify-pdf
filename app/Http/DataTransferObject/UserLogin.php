<?php

namespace App\Http\DataTransferObject;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

class UserLogin extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public static function fromRequest(LoginRequest $request): self
    {
        return self::from([
            ...$request->all()
        ]);
    }
}
