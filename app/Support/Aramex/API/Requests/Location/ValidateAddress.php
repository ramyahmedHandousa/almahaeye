<?php

namespace App\Support\Aramex\API\Requests\Location;

use App\Support\Aramex\API\Classes\Address;
use App\Support\Aramex\API\Interfaces\Normalize;
use App\Support\Aramex\API\Requests\API;
use App\Support\Aramex\API\Response\Location\AddressValidationResponse;

/**
 * This method Allows users to search for certain addresses and make sure that the address structure is correct.
 * The required nodes  to be filled are Client Info and Address,
 *
 * Class ValidateAddress
 * @package  App\Support\Aramex\API\Requests\Location
 */
class ValidateAddress extends API implements Normalize
{
    protected $live_wsdl = '/../WSDLs/live/location.xml';
    protected $test_wsdl = '/../WSDLs/test/location.xml';

    private $address;

    /**
     * @return AddressValidationResponse
     * @throws \Exception
     */
    public function run()
    {
        $this->validate();

        return AddressValidationResponse::make($this->soapClient->ValidateAddress($this->normalize()));
    }

    public function validate()
    {
        parent::validate();

        if (!$this->address) {
            throw new \Exception('Address should be provided.!');
        }

    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return ValidateAddress
     */
    public function setAddress(Address $address): ValidateAddress
    {
        $this->address = $address;
        return $this;
    }


    public function normalize(): array
    {
        return array_merge([
            'Address' => $this->getAddress()->normalize()
        ], parent::normalize());
    }
}
