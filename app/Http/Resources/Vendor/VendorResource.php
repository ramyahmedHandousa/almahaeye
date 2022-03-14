<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\List\CountryResource;
use App\Http\Resources\User\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'trade_name'    => $this->trade_name,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'type'          => $this->type,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'lang'          => $this->lang,
            'is_active'     => $this->is_active == 1,
            'api_token'     => $this->api_token,
            'image_profile' => $this->getFirstMediaUrl('master_image'),
            'country'       => new CountryResource($this->country),
            'location'      =>  new AddressResource($this->my_address)
        ];
    }
}
