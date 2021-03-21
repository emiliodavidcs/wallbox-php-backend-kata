<?php

namespace Kata\ElectricVehicle\Domain;

use Kata\Shared\Domain\DomainCollection;

final class ElectricVehicleCollection extends DomainCollection
{
    protected function getType(): string
    {
        return ElectricVehicle::class;
    }

}