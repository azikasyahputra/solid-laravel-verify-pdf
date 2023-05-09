<?php

namespace App\Http\Action;

class CheckIssuer
{
    public function __invoke(Object $document): bool
    {
        $issuerName = isset($document->data->issuer->name);
        $issuerIdentityProof = isset($document->data->issuer->identityProof);

        if ($issuerName && $issuerIdentityProof) {
            return true;
        } else {
            return false;
        }
    }
}
