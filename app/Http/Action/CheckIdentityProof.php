<?php

namespace App\Http\Action;
use Illuminate\Support\Facades\Http;

class CheckIdentityProof
{
    public function __invoke(Object $document): bool
    {
        $valid = false;
        
        $issuerLocation = isset($document->data->issuer->identityProof->location) ? $document->data->issuer->identityProof->location : '';
        $issuerIdentityProofKey = isset($document->data->issuer->identityProof->key) ? $document->data->issuer->identityProof->key : '';

        $response = Http::get("https://dns.google/resolve?name={$issuerLocation}&type=TXT");
        if (!$response->ok()) {
            return $valid;
        } else {
            $responseDns = $response->json();
            $answersDns = $responseDns['Answer'];
            foreach($answersDns as $answerDns){
                if(str_contains($answerDns['data'],$issuerIdentityProofKey)){
                    $valid = true;
                    break;
                }
            }
            return $valid;
        }
    }
}
