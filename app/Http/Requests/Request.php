<?php

namespace App\Http\Requests;

use App\Traits\Rest\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class Request extends FormRequest
{
    use ApiResponse;

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException($this->unprocessableApiResponse([$errors]));
    }
}
