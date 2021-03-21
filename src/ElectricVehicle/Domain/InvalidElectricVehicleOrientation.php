<?php

namespace Kata\ElectricVehicle\Domain;

use Kata\Shared\Domain\DomainError;

final class InvalidElectricVehicleOrientation extends DomainError
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;

        parent::__construct();
    }

    public function getErrorMessage(): string
    {
        return sprintf("The orientation value '%s' is not valid", $this->value);
    }
}