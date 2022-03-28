<?php

namespace App\Http\Requests\Website\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterVendorValid extends FormRequest
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
            'trade_name'    => 'required|min:2',
            'first_name'    => 'required|min:2',
            'last_name'     => 'required|min:4',
            'email'         => 'required|email|unique:users,email',
            'phone'         => 'required|numeric|unique:users,phone|digits:10|regex:/(05)[0-9]{8}/',
            'password'      => 'required',
            'confirm_password'   => 'required|same:password',
            'country_id'     => 'required|exists:countries,id',
            'bank_id'        => 'required|exists:banks,id',
            'latitude'       => 'required',
            'longitude'      => 'required',
            'address'        => 'required',

            'iban' => 'required|max:30',
            'commercial_registration' => 'required|string|max:30',

            'image_commercial'          => 'required|mimes:jpeg,png,jpg,pdf|max:20000',
//            'image_marketing_agreement' => 'required|mimes:jpeg,png,jpg,pdf|max:20000',
            'image_service_provider'    => 'required|mimes:jpeg,png,jpg,pdf|max:20000',
        ];
    }


    public function validated()
    {
        $data =  parent::validated();
        $data['type'] = 'vendor';
        $data['name'] = $this->first_name .'-'. $this->last_name;
        return collect($data)->except(['confirm_password','latitude','longitude','address',
            'image_commercial','image_marketing_agreement','image_service_provider'
            ])->toArray();
    }
}
