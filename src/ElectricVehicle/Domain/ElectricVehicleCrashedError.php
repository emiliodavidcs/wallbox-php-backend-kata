<?php

namespace Kata\ElectricVehicle\Domain;

use Kata\Shared\Domain\DomainError;

final class ElectricVehicleCrashedError extends DomainError
{
    public function getErrorMessage(): string
    {
        return 'Vehicles have crashed';
    }
}