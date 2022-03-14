<?php

namespace App\Http\Requests\Api\User\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressValid extends FormRequest
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
            'address'   => 'sometimes|string',
            'latitude'  => 'sometimes',
            'longitude' => 'sometimes',
            'notes'     => 'sometimes|string'
        ];
    }
}
