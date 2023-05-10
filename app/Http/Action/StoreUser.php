<?php

namespace App\Http\Action;

use App\Http\DataTransferObject\UserStore;
use App\Models\User;

class StoreUser
{
    public const ERROR_SAVING = 'Error Saving';
    public const SUCCESS_SAVING = 'Success Saving';

    public function __invoke(UserStore $request): string
    {
        $store = User::store($request);

        return $store ? self::SUCCESS_SAVING : self::ERROR_SAVING;
    }
}
