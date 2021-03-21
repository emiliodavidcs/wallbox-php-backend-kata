<?php

namespace Kata\ElectricVehicle\Domain;

use Kata\Shared\Domain\DomainError;

final class InvalidElectricVehiclePosition extends DomainError
{
    public function getErrorMessage(): string
    {
        return 'The electric vehicle position is not valid';
    }
}