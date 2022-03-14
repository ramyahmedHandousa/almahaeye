<?php

namespace App\Http\Requests\Api\Products;

use App\Http\Requests\Api\MasterApiFormRequest;

class StoreFavoriteProduct extends MasterApiFormRequest
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
            'product_id' => 'required|exists:products,id',
        ];
    }
}
