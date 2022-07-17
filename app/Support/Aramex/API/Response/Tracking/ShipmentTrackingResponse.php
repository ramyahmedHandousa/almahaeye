<?php

namespace App\Support\Aramex\API\Response\Tracking;

use App\Support\Aramex\API\Classes\TrackingResult;
use App\Support\Aramex\API\Response\Response;

class ShipmentTrackingResponse extends Response
{
    private $results;

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param $results
     * @return ShipmentTrackingResponse
     */
    public function setResults($results): ShipmentTrackingResponse
    {
        $this->results = $results;
        return $this;
    }

    /**
     * @param $result
     * @return ShipmentTrackingResponse
     */
    public function addResult(TrackingResult $result): ShipmentTrackingResponse
    {
        $this->results[] = $result;
        return $this;
    }

    /**
     * @param object $obj
     * @return self
     */
    protected function parse($obj)
    {
        parent::parse($obj);

        if ($result = $obj->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY) {
            $this->addResult(TrackingResult::parse($result));
        }

        return $this;
    }

    /**
     * @param object $obj
     * @return ShipmentTrackingResponse
     */
    public static function make($obj)
    {
        return (new self())->parse($obj);
    }
}
