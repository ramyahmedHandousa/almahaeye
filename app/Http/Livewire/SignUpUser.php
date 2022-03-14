<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SignUpUser extends Component
{
    public bool $userRegister = false;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $password;
    public $confirm_password;
    public $country_id;

    public $latitude;
    public $longitude;
    public $address;

    public $country;
    public $subCountry;
    public $subCountries=[];
    public $ciy;
    public $cities=[];
    public $stats =[];

    public object|null $user = null;
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone|digits:10|regex:/(05)[0-9]{8}/',
        ]);
    }

    public function save(Request $request)
    {
        $validatedData = $this->validate([
            'first_name'    => 'required|min:2',
            'last_name'     => 'required|min:4',
            'email'         => 'required|max:40|email|unique:users,email',
            'phone'         => 'required|unique:users,phone',
            'password'      => 'required',
//            'latitude'      => 'required',
//            'longitude'      => 'required',
//            'address'       => 'required',
            'confirm_password'   => 'required|same:password',
            'country'       => 'required|exists:countries,id',
            'subCountry'    => 'required|exists:countries,id',
            'ciy'           => 'required|exists:countries,id',
            'country_id'    => 'required|exists:countries,id',
        ]);

        try {

            $user = User::create($this->userData($request));

            VerifyUser::create(['user_id' => $user->id,'email' => $this->email,'phone' => $this->phone,
                                'action_code' => 1111
            ]);

            session()->flash('success','تم التعديل بنجاح');

            return redirect()->route('check-user-code',['token' => 123456]);

        }catch (\Exception $exception){

            Log::info($exception);

            return  redirect()->back();
        }

    }

    private function userData($request)
    {
        return [
            'type'          => 'client',
            'name'          => $this->first_name .'-'. $this->last_name,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'password'      => $this->password,
            'country_id'    => $this->country_id,
        ];
    }

    public function render()
    {
        if(!empty($this->country)) {
            $this->subCountries = Country::where('parent_id', $this->country)->get();
        }
        if(!empty($this->subCountry)) {
            $this->cities = Country::where('parent_id', $this->subCountry)->get();
        }
        if(!empty($this->ciy)) {
            $this->stats = Country::where('parent_id', $this->ciy)->get();
        }

        return view('livewire.sign-up-user',[
            'countries' => Country::whereNull('parent_id')->get()
        ]);
    }
}
