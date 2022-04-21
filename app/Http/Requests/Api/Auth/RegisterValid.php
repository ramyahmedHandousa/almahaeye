<?php

namespace App\Http\Requests\Api\Auth;


use App\Http\Requests\Api\MasterApiFormRequest;

class RegisterValid extends MasterApiFormRequest
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
            'first_name'    => 'required|string|max:191',
            'last_name'     => 'required|string|max:191',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|numeric|unique:users,phone|digits:10|regex:/(05)[0-9]{8}/',
            'password'      => 'required',
            'country_id'    => 'required|exists:countries,id',
            'latitude'      => 'required',
            'longitude'      => 'required',
            'address'       => 'required',
            'city_address'  => 'required',
            'image'         => 'sometimes|mimes:jpeg,png,jpg|max:20000'
        ];
    }

    public function validated()
    {
        $data =  parent::validated();
        $data['name'] = $this->first_name. '-'.$this->last_name;

        return collect($data)->except('image','latitude','longitude','address')->toArray();
    }
}
