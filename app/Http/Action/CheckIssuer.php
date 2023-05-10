<?php

namespace App\Http\Action;

use App\Http\DataTransferObject\DocumentIssuer;

class CheckIssuer
{
    public function __invoke(DocumentIssuer $request): bool
    {
        $issuerName = isset($request->name);
        $issuerIdentityProof = isset($request->identityProof);

        return $issuerName && $issuerIdentityProof;
    }
}
