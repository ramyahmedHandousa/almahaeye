<?php

namespace App\Support\Aramex\API\Requests\Location;

use App\Support\Aramex\API\Interfaces\Normalize;
use App\Support\Aramex\API\Requests\API;
use App\Support\Aramex\API\Response\Location\DropOffLocationsFetchingResponse;
use Exception;

/**
 * This method allows users to get list of the available ARAMEX offices within a certain country.
 * The required nodes to be filled are Client Info and Country Code.
 *
 * Class FetchDropOffLocations
 * @package  App\Support\Aramex\API\Requests\Location
 */
class FetchDropOffLocations extends API implements Normalize
{
    protected $live_wsdl = '/../WSDLs/live/location.xml';
    protected $test_wsdl = '/../WSDLs/test/location.xml';

}
