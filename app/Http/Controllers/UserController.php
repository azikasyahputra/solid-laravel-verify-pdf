<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\DataTransferObject\UserStore;
use App\Http\Action\StoreUser;
use App\Http\Response\ApiResponse;
use App\Constant\ResponseCode;

class UserController extends Controller
{
    public function register(StoreUserRequest $request, StoreUser $storeUser) : ApiResponse
    {
        $userData = UserStore::fromRequest($request);
        $storeUser = $storeUser($userData);

        return new ApiResponse($storeUser, ResponseCode::SUCCESS);
    }
}
