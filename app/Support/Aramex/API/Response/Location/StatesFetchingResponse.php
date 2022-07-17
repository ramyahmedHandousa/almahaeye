<?php

namespace App\Support\Aramex\API\Response\Location;

use App\Support\Aramex\API\Classes\State;
use App\Support\Aramex\API\Response\Response;

class StatesFetchingResponse extends Response
{
    private $states;


    public function getStates()
    {
        return $this->states;
    }


    public function setStates(  $states)
    {
        $this->states = $states;
        return $this;
    }

    public function addState( $state)
    {
        $this->states[] = $state;
        return $this;
    }


    protected function parse($obj)
    {
        parent::parse($obj);

        if ($obj->States && property_exists($obj->States, 'State')) {
            $states = $obj->States->State;

            foreach ($states as $state) {
                $this->addState(
                    (new State())
                        ->setCode($state->Code)
                        ->setName($state->Name)
                );
            }
        }

        return $this;
    }


    public static function make($obj)
    {
        return (new self())->parse($obj);
    }

}
