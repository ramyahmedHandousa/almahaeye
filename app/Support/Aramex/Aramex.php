<?php

namespace App\Support\Aramex;

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

class Aramex
{

//#[ProductGroup] => EXP
//#[ProductType] => PDX
//#[PaymentType] => P
//
//#[ProductGroup] => DOM
//#[ProductType] => CDS
//#[PaymentType] => 3
//
//#CODS
//
//#9729

    // Location
    public static function fetchCities()
    {
        return new FetchCities();
    }

    public static function fetchCountries()
    {
        return new FetchCountries();
    }

    public static function fetchCountry()
    {
        return new FetchCountry();
    }

    public static function fetchDropOffLocations()
    {
        return new FetchDropOffLocations();
    }

    public static function fetchOffices()
    {
        return new FetchOffices();
    }

    public static function fetchStates()
    {
        return new FetchStates();
    }

    public static function validateAddress()
    {
        return new ValidateAddress();
    }

    // Rate
    public static function calculateRate()
    {
        return new CalculateRate();
    }

    // Shipping
    public static function cancelPickup()
    {
        return new CancelPickup();
    }

    public static function createPickup()
    {
        return new CreatePickup();
    }

    public static function createShipments()
    {
        return new CreateShipments();
    }

    public static function getLastShipmentsNumbersRange()
    {
        return new GetLastShipmentsNumbersRange();
    }

    public static function printLabel()
    {
        return new PrintLabel();
    }

    public static function reserveShipmentNumberRange()
    {
        return new ReserveShipmentNumberRange();
    }

    public static function scheduleDelivery()
    {
        return new ScheduleDelivery();
    }

    // Tracking
    public static function trackPickup()
    {
        return new TrackPickup();
    }

    public static function trackShipments()
    {
        return new TrackShipments();
    }
}
