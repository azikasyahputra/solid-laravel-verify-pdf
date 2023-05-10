<?php

namespace App\Http\Action;

use Illuminate\Support\Facades\Http;
use App\Http\DataTransferObject\DocumentIssuer;

class CheckIdentityProof
{
    public function __invoke(DocumentIssuer $request): bool
    {
        $valid = false;

        $issuerLocation = isset($request->identityProof->location) ? $request->identityProof->location : '';
        $issuerIdentityProofKey = isset($request->identityProof->key) ? $request->identityProof->key : '';

        $response = Http::get("https://dns.google/resolve?name={$issuerLocation}&type=TXT");
        if ($response->ok()) {
            $responseDns = $response->json();
            $answersDns = $responseDns['Answer'];
            foreach ($answersDns as $answerDns) {
                if (str_contains($answerDns['data'], $issuerIdentityProofKey)) {
                    $valid = true;
                    break;
                }
            }
        }
        return $valid;
    }
}
