<?php

namespace App\Http\Requests\Website\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValid extends FormRequest
{

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
            'first_name'    => 'required|min:2',
            'last_name'     => 'required|min:4',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|numeric|unique:users,phone|digits:10|regex:/(05)[0-9]{8}/',
            'password'      => 'required',
            'confirm_password'   => 'required|same:password',
            'country_id'    => 'required|exists:countries,id',
            'latitude'      => 'required',
            'longitude'      => 'required',
            'address'       => 'required',
            'city_address'  => 'required|string|max:500'
        ];
    }


    public function validated()
    {
        $data =  parent::validated();
        $data['type'] = 'client';
        $data['name'] = $this->first_name .'-'. $this->last_name;
        $data['city_address'] = $this->city_address;
        return collect($data)->except(['confirm_password','latitude','longitude','address'])->toArray();
    }
}
