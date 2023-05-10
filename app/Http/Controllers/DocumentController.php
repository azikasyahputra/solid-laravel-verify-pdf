<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\DocumentContentRequest;

use App\Http\DataTransferObject\DocumentVerifiedStatus;
use App\Http\DataTransferObject\VerificationResultStore;

use App\Http\Action\ReadFileContent;
use App\Http\Action\CheckRecipient;
use App\Http\Action\CheckIssuer;
use App\Http\Action\CheckIdentityProof;
use App\Http\Action\CheckSignature;
use App\Constant\ResponseCode;
use App\Constant\DocumentResponse;
use App\Http\Resource\DocumentVerifiedResource;

use App\Http\Action\StoreVerificationResult;

class DocumentController extends Controller
{
    public function store(
        StoreDocumentRequest $request,
        ReadFileContent $readFileContent,
        CheckRecipient $checkRecipient,
        CheckIssuer $checkIssuer,
        CheckIdentityProof $checkIdentityProof,
        CheckSignature $checkSignature,
        StoreVerificationResult $storeVerificationResult
    ): DocumentVerifiedResource {
        $documentResponse = '';

        $file = $request->file('document');
        $readFileContent = $readFileContent($file);

        $userId = isset($readFileContent->data->id) ? $readFileContent->data->id : '';
        $issuerName = isset($readFileContent->data->issuer->name) ? $readFileContent->data->issuer->name : '';
        $fileType = $file->getClientOriginalExtension();

        if (!$checkRecipient($readFileContent)) {
            $documentResponse = DocumentResponse::INVALID_RECIPIENT;
        } else if (!$checkIssuer($readFileContent) || !$checkIdentityProof($readFileContent) || !$checkSignature($readFileContent)) {
            $documentResponse = DocumentResponse::INVALID_ISSUER;
        } else {
            $documentResponse = DocumentResponse::VERIFIED;
        }

        $documentVerifiedStatusData = new DocumentVerifiedStatus($issuerName, $documentResponse);

        $verificationResultData = new VerificationResultStore($userId, $fileType, $documentResponse);
        $storeVerificationResult = $storeVerificationResult($verificationResultData);

        return new DocumentVerifiedResource($documentVerifiedStatusData);
    }
}
