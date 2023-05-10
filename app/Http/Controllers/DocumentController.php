<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;

use App\Http\DataTransferObject\DocumentData;
use App\Http\DataTransferObject\DocumentRecipient;
use App\Http\DataTransferObject\DocumentIssuer;
use App\Http\DataTransferObject\DocumentVerifiedStatus;
use App\Http\DataTransferObject\VerificationResultStore;

use App\Http\Action\ReadFileContent;
use App\Http\Action\CheckRecipient;
use App\Http\Action\CheckIssuer;
use App\Http\Action\CheckIdentityProof;
use App\Http\Action\CheckSignature;
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
        StoreVerificationResult $storeVerificationResult,
    ): DocumentVerifiedResource {
        $documentResponse = '';
        $issuerName = '';

        $file = $request->file('document');
        $readFileContent = $readFileContent($file);

        $documentData = new DocumentData($readFileContent->data ?? (object)[], $readFileContent->signature ?? (object)[]);
        $documentRecipient = new DocumentRecipient($documentData->data->recipient->name ?? '', $documentData->data->recipient?->email ?? '');
        $documentIssuer = new DocumentIssuer($documentData->data->issuer->name ?? '', $documentData->data->issuer->identityProof ?? (object)[]);

        $issuerName = $documentIssuer->name;
        $fileType = $file->getClientOriginalExtension();

        if (!$checkRecipient($documentRecipient)) {
            $documentResponse = DocumentResponse::INVALID_RECIPIENT;
        } else if (!$checkIssuer($documentIssuer) || !$checkIdentityProof($documentIssuer) || !$checkSignature($documentData)) {
            $documentResponse = DocumentResponse::INVALID_ISSUER;
        } else {
            $documentResponse = DocumentResponse::VERIFIED;
        }

        if (isset($documentData->data->id)) {
            $verificationResultData = new VerificationResultStore($documentData->data->id, $fileType, $documentResponse);
            $storeVerificationResult = $storeVerificationResult($verificationResultData);
        }

        $documentVerifiedStatusData = new DocumentVerifiedStatus($issuerName, $documentResponse);
        return new DocumentVerifiedResource($documentVerifiedStatusData);
    }
}
