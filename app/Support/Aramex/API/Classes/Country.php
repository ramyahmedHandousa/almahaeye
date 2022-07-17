<?php


namespace App\Support\Aramex\API\Classes;

use App\Support\Aramex\API\Interfaces\Normalize;

/**
 * Required – None.
 *
 * Class Country
 * @package  App\Support\Aramex\API\Classes
 */
class Country implements Normalize
{
    private $code;
    private $name;
    private $isoCode;
    private $stateRequired = false;
    private $postCodeRequired = false;
    private $postCodeRegex;
    private $internationalCallingNumber;


    public function getCode(): ?string
    {
        return $this->code;
    }


    public function setCode(string $code): Country
    {
        $this->code = $code;
        return $this;
    }


    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName(string $name): Country
    {
        $this->name = $name;
        return $this;
    }


    public function getIsoCode(): ?string
    {
        return $this->isoCode;
    }


    public function setIsoCode(string $isoCode): Country
    {
        $this->isoCode = $isoCode;
        return $this;
    }


    public function getStateRequired(): bool
    {
        return $this->stateRequired;
    }


    public function setStateRequired(bool $stateRequired): Country
    {
        $this->stateRequired = $stateRequired;
        return $this;
    }

    public function getPostCodeRequired(): bool
    {
        return $this->postCodeRequired;
    }


    public function setPostCodeRequired(bool $postCodeRequired): Country
    {
        $this->postCodeRequired = $postCodeRequired;
        return $this;
    }


    public function getPostCodeRegex(): ?array
    {
        return $this->postCodeRegex;
    }

    public function setPostCodeRegex(array $postCodeRegex): Country
    {
        $this->postCodeRegex = $postCodeRegex;
        return $this;
    }


    public function getInternationalCallingNumber(): ?string
    {
        return $this->internationalCallingNumber;
    }


    public function setInternationalCallingNumber(string $internationalCallingNumber): Country
    {
        $this->internationalCallingNumber = $internationalCallingNumber;
        return $this;
    }

    public function normalize(): array
    {
        return [
            'Code' => $this->getCode(),
            'Name' => $this->getName(),
            'IsoCode' => $this->getIsoCode(),
            'StateRequired' => $this->getStateRequired(),
            'PostCodeRequired' => $this->getPostCodeRequired(),
            'PostCodeRegex' => $this->getPostCodeRegex(),
            'InternationalCallingNumber' => $this->getInternationalCallingNumber(),
        ];
    }
}
