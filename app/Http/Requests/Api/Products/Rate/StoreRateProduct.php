<?php

namespace App\Http\Requests\Api\Products\Rate;

use App\Http\Requests\Api\MasterApiFormRequest;

class StoreRateProduct extends MasterApiFormRequest
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
            'parent_id'     => 'sometimes|exists:product_rates,id',
            'product_id'    => 'required|exists:products,id',
            'rate'          => 'sometimes|integer|between:1,5',
            'comment'       => 'sometimes|string|max:5000'
        ];
    }

}
