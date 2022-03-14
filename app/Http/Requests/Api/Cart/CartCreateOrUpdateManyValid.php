<?php

namespace App\Http\Requests\Api\Cart;

use App\Http\Requests\Api\MasterApiFormRequest;

class CartCreateOrUpdateManyValid extends MasterApiFormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'products'          => 'required|array',
            'products.*.id'     => 'required|exists:products,id',
        ];
    }
}
