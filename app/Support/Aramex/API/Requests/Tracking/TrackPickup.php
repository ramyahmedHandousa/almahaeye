<?php

namespace App\Support\Aramex\API\Requests\Tracking;

use Exception;
use App\Support\Aramex\API\Interfaces\Normalize;
use App\Support\Aramex\API\Requests\API;
use App\Support\Aramex\API\Response\Tracking\PickupTrackingResponse;

/**
 * This method allows the user to track an existing pickup’s updates and latest status.
 *
 * Class TrackPickup
 * @package ExtremeSa\Aramex\API\Requests\Tracking
 */
class TrackPickup extends API implements Normalize
{
    protected $live_wsdl = '/../WSDLs/live/tracking.xml';
    protected $test_wsdl = '/../WSDLs/test/tracking.xml';

    private $shipments;
    private $reference;
    private $pickup;

    /**
     * @return PickupTrackingResponse
     * @throws Exception
     */
    public function run()
    {
        $this->validate();

        return PickupTrackingResponse::make($this->soapClient->TrackPickup($this->normalize()));
    }

    protected function validate()
    {
        if (!$this->reference) {
            throw new Exception('Reference is not provided');
        }

        if (!$this->pickup) {
            throw new Exception('Pickup is not provided');
        }
    }

    /**
     * @return array
     */
    public function getShipments()
    {
        return $this->shipments;
    }

    /**
     * @param array $shipments
     * @return TrackPickup
     */
    public function setShipments(array $shipments): TrackPickup
    {
        $this->shipments = $shipments;
        return $this;
    }

    /**
     * @param string $shipment
     * @return TrackPickup
     */
    public function addShipment(string $shipment): TrackPickup
    {
        $this->shipments[] = $shipment;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     * @return TrackPickup
     */
    public function setReference($reference): TrackPickup
    {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPickup()
    {
        return $this->pickup;
    }

    /**
     * @param mixed $pickup
     * @return TrackPickup
     */
    public function setPickup($pickup): TrackPickup
    {
        $this->pickup = $pickup;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'Shipments' => $this->getShipments(),
            'Reference' => $this->getReference(),
            'Pickup' => $this->getPickup(),
        ], parent::normalize());
    }

}
