<?php

namespace App\Support\Aramex\API\Requests\Shipping;

use Exception;
use App\Support\Aramex\API\Classes\LabelInfo;
use App\Support\Aramex\API\Classes\Pickup;
use App\Support\Aramex\API\Interfaces\Normalize;
use App\Support\Aramex\API\Requests\API;
use App\Support\Aramex\API\Response\Shipping\PickupCreationResponse;

/**
 * This method allows users to create a pickup request.
 * The nodes required to be filled are as follows: ClientInfo and Pickup.
 *
 * Class PickupCreation
 * @package App\Support\Aramex\API\Requests
 */
class CreatePickup extends API implements Normalize
{
    protected $live_wsdl = '/../WSDLs/live/shipping.xml';
    protected $test_wsdl = '/../WSDLs/test/shipping.xml';

    private $pickup;
    private $labelInfo;

    /**
     * @return PickupCreationResponse
     * @throws Exception
     */
    public function run(): PickupCreationResponse
    {
        $this->validate();

        return PickupCreationResponse::make($this->soapClient->CreatePickup($this->normalize()));
    }

    /**
     * @return Pickup
     */
    public function getPickup()
    {
        return $this->pickup;
    }

    /**
     * @param Pickup $pickup
     * @return CreatePickup
     */
    public function setPickup(Pickup $pickup): CreatePickup
    {
        $this->pickup = $pickup;
        return $this;
    }

    /**
     * @return LabelInfo|null
     */
    public function getLabelInfo()
    {
        return $this->labelInfo;
    }

    /**
     * @param LabelInfo $labelInfo
     * @return CreatePickup
     */
    public function setLabelInfo(LabelInfo $labelInfo): CreatePickup
    {
        $this->labelInfo = $labelInfo;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'Pickup' => $this->getPickup()->normalize(),
            'LabelInfo' => optional($this->getLabelInfo())->normalize(),
        ], parent::normalize());
    }
}
