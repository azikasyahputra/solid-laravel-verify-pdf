<?php

namespace App\Http\Action;

use App\Http\DataTransferObject\UserLogin;

class VerifyUser
{
    public const ERROR_INVALID_USER = 'Invalid User';

    public function __invoke(UserLogin $request): string
    {
        $token = auth()->guard('api')->attempt(['email' => $request->email, 'password' => $request->password]);

        return $token ? $token : self::ERROR_INVALID_USER;
    }
}
