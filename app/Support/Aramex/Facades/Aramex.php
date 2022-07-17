<?php

namespace App\Support\Aramex\Facades;

use App\Support\Aramex\API\Requests\Location\FetchCities;
use App\Support\Aramex\API\Requests\Location\FetchCountries;
use App\Support\Aramex\API\Requests\Location\FetchCountry;
use App\Support\Aramex\API\Requests\Location\FetchDropOffLocations;
use App\Support\Aramex\API\Requests\Location\FetchOffices;
use App\Support\Aramex\API\Requests\Location\FetchStates;
use App\Support\Aramex\API\Requests\Location\ValidateAddress;
use App\Support\Aramex\API\Requests\Rate\CalculateRate;
use App\Support\Aramex\API\Requests\Shipping\CancelPickup;
use App\Support\Aramex\API\Requests\Shipping\CreatePickup;
use App\Support\Aramex\API\Requests\Shipping\CreateShipments;
use App\Support\Aramex\API\Requests\Shipping\GetLastShipmentsNumbersRange;
use App\Support\Aramex\API\Requests\Shipping\PrintLabel;
use App\Support\Aramex\API\Requests\Shipping\ReserveShipmentNumberRange;
use App\Support\Aramex\API\Requests\Shipping\ScheduleDelivery;
use App\Support\Aramex\API\Requests\Tracking\TrackPickup;
use App\Support\Aramex\API\Requests\Tracking\TrackShipments;
use App\Support\Aramex\Aramex as AramexClass;
use Illuminate\Support\Facades\Facade;

/**
 * Class Aramex
 * @package App\Support\Aramex
 *
 * @method static FetchCities fetchCities
 * @method static FetchCountries fetchCountries
 * @method static FetchCountry fetchCountry
 * @method static FetchDropOffLocations fetchDropOffLocations
 * @method static FetchOffices fetchOffices
 * @method static FetchStates fetchStates
 * @method static ValidateAddress validateAddress
 * @method static CalculateRate calculateRate
 * @method static CancelPickup cancelPickup
 * @method static CreatePickup createPickup
 * @method static CreateShipments createShipments
 * @method static GetLastShipmentsNumbersRange getLastShipmentsNumbersRange
 * @method static PrintLabel printLabel
 * @method static ReserveShipmentNumberRange reserveShipmentNumberRange
 * @method static ScheduleDelivery scheduleDelivery
 * @method static TrackPickup trackPickup
 * @method static TrackShipments trackShipments
 */
class Aramex extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AramexClass::class;
    }
}
