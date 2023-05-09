<?php

namespace App\Http\Action;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LogoutUser
{
    public const SUCCESS = 'Logout Success';

    public function __invoke(): string
    {
        $removeToken = JWTAuth::invalidate(JWTAuth::getToken());
        return self::SUCCESS;
    }
}
