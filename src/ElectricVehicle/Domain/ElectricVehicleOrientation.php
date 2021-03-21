<?php

namespace Kata\ElectricVehicle\Domain;

use Kata\Shared\Domain\ValueObject\EnumValueObject;

final class ElectricVehicleOrientation extends EnumValueObject
{
    const NORTH = 'N';
    const EAST = 'E';
    const SOUTH = 'S';
    const WEST = 'W';

    protected function throwExceptionForInvalidValue($value): void
    {
        throw new InvalidElectricVehicleOrientation($value);
    }
}