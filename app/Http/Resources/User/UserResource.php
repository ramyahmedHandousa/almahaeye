<?php

namespace App\Http\Resources\User;

use App\Http\Resources\List\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
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
