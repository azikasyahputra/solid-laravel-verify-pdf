<?php

namespace App\Http\Action;

use Illuminate\Support\Arr;
use App\Http\DataTransferObject\DocumentData;

class CheckSignature
{
    public function __invoke(DocumentData $request): bool
    {
        $valid = false;
        $targetHashData = $request->signature->targetHash;

        $arrayHashData = [];
        $documentDatas = Arr::dot(json_decode(json_encode($request->data), true));
        foreach ($documentDatas as $key => $documentData) {
            $dataString = json_encode([$key => $documentData]);
            $hashing = hash('sha256', $dataString);
            array_push($arrayHashData, $hashing);
        }
        sort($arrayHashData);
        $resultHashDocument = hash('sha256', json_encode($arrayHashData));

        return $targetHashData == $resultHashDocument;
    }
}
