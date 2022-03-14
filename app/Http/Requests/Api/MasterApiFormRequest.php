<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MasterApiFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $values = $validator->errors()->all();

        throw new HttpResponseException(response()->json(['status'=>400 ,'errors'=> $values],400));
    }
}
