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

        if ($store) {
            return self::SUCCESS_SAVING;
        } else {
            return self::ERROR_SAVING;
        }
    }
}
