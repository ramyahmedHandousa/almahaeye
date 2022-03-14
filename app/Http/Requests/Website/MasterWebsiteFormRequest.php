<?php

namespace App\Http\Requests\Website;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MasterWebsiteFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $values = $validator->errors()->all();

        throw new HttpResponseException(response()->json(['status'=>400 ,'errors'=> $values],400));
    }
}
