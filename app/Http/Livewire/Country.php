<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Country as CountryModel;

class Country extends Component
{

    public $country;
    public $subCountry;
    public $subCountries=[];
    public $ciy;
    public $cities=[];
    public $stats =[];

    public function render()
    {
        if(!empty($this->country)) {
            $this->subCountries = CountryModel::where('parent_id', $this->country)->get();
        }
        if(!empty($this->subCountry)) {
            $this->cities = CountryModel::where('parent_id', $this->subCountry)->get();
        }
        if(!empty($this->ciy)) {
            $this->stats = CountryModel::where('parent_id', $this->ciy)->get();
        }

        return view('livewire.country',[
            'countries' => CountryModel::whereNull('parent_id')->get()
        ]);
    }
}
