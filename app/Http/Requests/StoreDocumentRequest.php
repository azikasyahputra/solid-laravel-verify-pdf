<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\File;

class StoreDocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'document' => ['required', File::types(['json']), 'max:2048'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(new JsonResponse($validator->errors(), 422));
    }
}
