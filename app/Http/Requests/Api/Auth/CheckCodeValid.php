<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\MasterApiFormRequest;
use Illuminate\Validation\Rule;

class CheckCodeValid extends MasterApiFormRequest
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
            'phone' => 'required|exists:verify_users,phone',
            'code'  => ['required',Rule::exists('verify_users','action_code')
                                    ->where(fn ($query) => $query->where('phone', $this->phone)),
            ]
        ];
    }
}
