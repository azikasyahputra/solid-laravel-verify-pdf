<?php

namespace App\Http\Action;
use Illuminate\Support\Arr;

class CheckSignature
{
    public function __invoke(Object $document): bool
    {
        $valid = false;
        $targetHashData = $document->signature->targetHash;

        $arrayHashData = [];
        $documentDatas = Arr::dot(json_decode(json_encode($document->data),true));
        foreach($documentDatas as $key => $documentData){
            $dataString = json_encode([$key=>$documentData]);
            $hashing = hash('sha256',$dataString);
            array_push($arrayHashData,$hashing);
        }
        sort($arrayHashData);
        $resultHashDocument = hash('sha256',json_encode($arrayHashData));

        if($targetHashData == $resultHashDocument){
            return true;
        }else{
            return false;
        }
    }
}
