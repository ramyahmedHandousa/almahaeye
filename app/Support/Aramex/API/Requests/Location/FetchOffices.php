<?php

namespace App\Support\Aramex\API\Requests\Location;

use Exception;
use App\Support\Aramex\API\Interfaces\Normalize;
use App\Support\Aramex\API\Requests\API;
use App\Support\Aramex\API\Response\Location\OfficesFetchingResponse;

/**
 * This method allows users to get list of the available ARAMEX offices within a certain country.
 * The required nodes  to be filled are Client Info and Country Code.
 *
 * Class FetchOffices
 * @package  App\Support\Aramex\API\Requests\Location
 */
class FetchOffices extends API implements Normalize
{
    protected $live_wsdl = '/../WSDLs/live/location.xml';
    protected $test_wsdl = '/../WSDLs/test/location.xml';

    private $countryCode;

    /**
     * @return OfficesFetchingResponse
     * @throws Exception
     */
    public function run()
    {
        $this->validate();

        return OfficesFetchingResponse::make($this->soapClient->FetchOffices($this->normalize()));
    }

    protected function validate()
    {
        parent::validate();

        if (!$this->countryCode) {
            throw new Exception('Should provide country code!');
        }
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return FetchOffices
     */
    public function setCountryCode(string $countryCode): FetchOffices
    {
        $this->countryCode = $countryCode;
        return $this;
    }


    public function normalize(): array
    {
        return array_merge([
            'CountryCode' => $this->getCountryCode()
        ], parent::normalize());
    }
}
