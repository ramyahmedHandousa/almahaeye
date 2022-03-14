<?php

namespace App\Http\Requests\Website\Auth;

use App\Http\Requests\Website\MasterWebsiteFormRequest;

class LoginValid extends MasterWebsiteFormRequest
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
            'email' => 'required|email',
            'password' => 'required'
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator){

            if ($this->email && $this->password){

                if (! $token = auth()->attempt(['email' => $this->email, 'password' => $this->password])) {

                    $validator->errors()->add('unavailable', trans('global.username_password_notcorrect'));
                    return;
                }else{
                    $user = $this->user();

                    if ($user->is_suspend == 1){
                        $validator->errors()->add('unavailable', trans('global.your_account_suspended'));
                        return;
                    }
                }
            }

        });
    }

}
