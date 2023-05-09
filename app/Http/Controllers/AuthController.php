<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\DataTransferObject\UserLogin;
use App\Http\Action\VerifyUser;
use App\Http\Action\LogoutUser;
use App\Http\Response\ApiResponse;
use App\Constant\ResponseCode;

class AuthController extends Controller
{
    public function login(LoginRequest $request, VerifyUser $verifyUser): ApiResponse
    {
        $userData = UserLogin::fromRequest($request);
        $authenticate = $verifyUser($userData);

        return new ApiResponse($authenticate, ResponseCode::SUCCESS);
    }

    public function logout(LogoutUser $logoutUser)
    {
        $logout = $logoutUser();
        return new ApiResponse($logout, ResponseCode::SUCCESS);
    }
}
