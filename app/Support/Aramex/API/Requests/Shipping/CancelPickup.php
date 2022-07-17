<?php

namespace App\Support\Aramex\API\Requests\Shipping;

use Exception;
use App\Support\Aramex\API\Interfaces\Normalize;
use App\Support\Aramex\API\Requests\API;
use App\Support\Aramex\API\Response\Shipping\PickupCancellationResponse;

/**
 * This method allows you to cancel a pickup as long as it is un-assigned or pending details.
 *
 * Class PickupCancellation
 * @package ExtremeSa\Aramex\API\Requests
 */
class CancelPickup extends API implements Normalize
{
    protected $live_wsdl = '/../WSDLs/live/shipping.xml';
    protected $test_wsdl = '/../WSDLs/test/shipping.xml';

    private $pickupGUID;
    private $comments;

    /**
     * @return PickupCancellationResponse
     * @throws Exception
     */
    public function run(): PickupCancellationResponse
    {
        $this->validate();

        return PickupCancellationResponse::make($this->soapClient->CancelPickup($this->normalize()));
    }

    /**
     * @throws \Exception
     */
    protected function validate()
    {
        parent::validate();

        if (!$this->pickupGUID) {
            throw new \Exception('PickupGUID Not Provided');
        }
    }

    /**
     * @return string
     */
    public function getPickupGUID(): string
    {
        return $this->pickupGUID;
    }

    /**
     * @param string $pickupGUID
     * @return CancelPickup
     */
    public function setPickupGUID(string $pickupGUID): CancelPickup
    {
        $this->pickupGUID = $pickupGUID;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComments(): ?string
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     * @return CancelPickup
     */
    public function setComments(string $comments = null): CancelPickup
    {
        $this->comments = $comments;
        return $this;
    }

    public function normalize(): array
    {
        return array_merge([
            'PickupGUID' => $this->getPickupGUID(),
            'Comments' => $this->getComments(),
        ], parent::normalize());
    }
}
