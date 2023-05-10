<?php

namespace App\Http\Action;

use App\Http\DataTransferObject\VerificationResultStore;
use App\Models\VerificationResult;

class StoreVerificationResult
{
    public function __invoke(VerificationResultStore $request): bool
    {
        $store = VerificationResult::store($request);

        return $store ? true : false;
    }
}
