<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required', 'string', 'max:255'
            ],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' =>  ['required', 'string', 'max:255', 'min:8'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(new JsonResponse($validator->errors(), 422));
    }
}
