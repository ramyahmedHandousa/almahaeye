<?php

namespace App\Support\Aramex\API\Requests\Shipping;

use Exception;
use App\Support\Aramex\API\Classes\LabelInfo;
use App\Support\Aramex\API\Classes\Shipment;
use App\Support\Aramex\API\Interfaces\Normalize;
use App\Support\Aramex\API\Requests\API;
use App\Support\Aramex\API\Response\Shipping\ShipmentCreationResponse;

/**
 * This method allows users to create shipments on Aramex’s system.
 * The required nodes to be filled are: Client Info and Shipments.
 *
 * Class ShipmentCreation
 * @package ExtremeSa\Aramex\API\Requests
 */
class CreateShipments extends API implements Normalize
{
    protected $live_wsdl = '/../WSDLs/live/shipping.xml';
    protected $test_wsdl = '/../WSDLs/test/shipping.xml';

    private $shipments;
    private $labelInfo;

    /**
     * @return ShipmentCreationResponse
     * @throws Exception
     */
    public function run(): ShipmentCreationResponse
    {
        $this->validate();

        return ShipmentCreationResponse::make($this->soapClient->CreateShipments($this->normalize()));
    }

    protected function validate()
    {
        parent::validate();

        if (!$this->shipments) {
            throw new Exception('Shipments are not provided');
        }
    }

    /**
     * @return Shipment[]
     */
    public function getShipments()
    {
        return $this->shipments;
    }

    /**
     * @param Shipment[] $shipments
     * @return CreateShipments
     */
    public function setShipments(array $shipments): CreateShipments
    {
        $this->shipments = $shipments;
        return $this;
    }

    /**
     * @param Shipment $shipment
     * @return CreateShipments
     */
    public function addShipment(Shipment $shipment): CreateShipments
    {
        $this->shipments[] = $shipment;
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
     * @return CreateShipments
     */
    public function setLabelInfo(LabelInfo $labelInfo): CreateShipments
    {
        $this->labelInfo = $labelInfo;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'Shipments' => $this->getShipments() ? array_map(function ($item) {
                /** @var Shipment $item */
                return $item->normalize();
            }, $this->getShipments()) : [],
            'LabelInfo' => optional($this->getLabelInfo())->normalize(),
        ], parent::normalize());
    }
}
