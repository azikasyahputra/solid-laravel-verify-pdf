<?php

namespace App\Http\DataTransferObject;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

class UserStore extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public static function fromRequest(StoreUserRequest $request): self
    {
        return self::from([
            ...$request->all(),
            'password' => Hash::make($request->password),
        ]);
    }
}
