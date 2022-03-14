<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\MasterApiFormRequest;

class LoginValid extends MasterApiFormRequest
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
            'phone' => 'required',
            'password' => 'required'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){

            if ($this->phone && $this->password){

                if (! $token = auth()->attempt(['phone' => $this->phone, 'password' => $this->password])) {

                    $validator->errors()->add('unavailable', trans('global.username_password_notcorrect'));
                    return;
                }else{
                    $user = $this->user();


                    if (!in_array($user->type,['client','vendor'])){
                        $validator->errors()->add('unavailable', trans('global.account_not_found'));
                        return;
                    }

                    if ($user->is_suspend == 1){
                        $validator->errors()->add('unavailable', trans('global.your_account_suspended'));
                        return;
                    }
                }
            }

        });
    }
}
