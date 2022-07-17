<?php

namespace App\Support\Aramex\API\Classes;

use App\Support\Aramex\API\Interfaces\Normalize;

/**
 * Returns the Label as URL with Label URL element or as a file with Label File Contents.
 * Class ShipmentLabel
 * @package  App\Support\Aramex\API\Classes
 */
class ShipmentLabel implements Normalize
{
    private $labelUrl;
    private $labelFileContents;

    /**
     * @return string
     */
    public function getLabelUrl(): string
    {
        return $this->labelUrl;
    }

    /**
     * @param string $labelUrl
     * @return ShipmentLabel
     */
    public function setLabelUrl(string $labelUrl): ShipmentLabel
    {
        $this->labelUrl = $labelUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabelFileContents(): string
    {
        return $this->labelFileContents;
    }

    /**
     * @param string $labelFileContents
     * @return ShipmentLabel
     */
    public function setLabelFileContents(string $labelFileContents): ShipmentLabel
    {
        $this->labelFileContents = $labelFileContents;
        return $this;
    }

    public function normalize(): array
    {
        return [
            'LabelUrl' => $this->getLabelUrl(),
            'LabelFileContents' => $this->getLabelFileContents(),
        ];
    }

}
