<?php

namespace App\Http\Requests\Api\Products\Rate;

use App\Http\Requests\Api\MasterApiFormRequest;

class UpdateRateProduct extends MasterApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rate'          => 'sometimes|integer|between:1,5',
            'comment'       => 'sometimes|string|max:5000'
        ];
    }
}
