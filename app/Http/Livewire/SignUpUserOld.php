<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class SignUpUserOld extends Component
{
    public $name;
    public $email;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save(Request $request)
    {
       $validatedData = $this->validate();
//
//        // Add registration data to modal
       return redirect()->back();
    }

    public function render()
    {

        return view('livewire.sign-up-user')
            ->extends('website.layouts.master')
            ;
    }



}
