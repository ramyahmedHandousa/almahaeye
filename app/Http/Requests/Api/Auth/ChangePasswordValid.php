<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\MasterApiFormRequest;
use App\Support\Facade\Responder;
use Illuminate\Support\Facades\Hash;

class ChangePasswordValid extends MasterApiFormRequest
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
            'new_password' => 'sometimes',
            'old_password' => 'required_with:new_password'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){

            if ($this->new_password){

                if (!Hash::check( $this->old_password , auth()->user()->password )){

                    $validator->errors()->add('unavailable',trans('global.old_password_is_incorrect'));
                }
            }

        });
    }
}
