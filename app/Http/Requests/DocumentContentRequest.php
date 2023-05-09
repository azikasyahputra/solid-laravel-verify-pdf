<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class DocumentContentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'data.recipient.name' => ['required', 'string'],
            'data.recipient.email' =>  ['required', 'string'],
            'data.issuer.email' =>  ['required', 'string'],
            'data.issuer.identityProof' =>  ['required', 'array'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(new JsonResponse($validator->errors(), 422));
    }
}
