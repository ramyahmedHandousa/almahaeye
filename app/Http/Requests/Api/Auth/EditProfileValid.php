<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\MasterApiFormRequest;

class EditProfileValid extends MasterApiFormRequest
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
            'first_name'    => 'sometimes|min:2',
            'last_name'     => 'sometimes|min:4',
            'country_id'    => 'sometimes|exists:countries,id',
            'email'         => 'sometimes|email|unique:users,email,'.auth()->id(),
            'phone'         => 'sometimes|digits:10|regex:/(05)[0-9]{8}/|numeric|unique:users,phone,'.auth()->id(),
            'image'         => 'sometimes|mimes:jpeg,png,jpg|max:20000',
        ];
    }


    public function validated()
    {
        $data =  parent::validated();

        return collect($data)->except('image','phone')->toArray();
    }
}
