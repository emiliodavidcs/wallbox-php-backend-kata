<?php

namespace Kata\ElectricVehicle\Application\Move;

use Kata\ElectricVehicle\Domain\ElectricVehicle;

interface ElectricVehicleMovementAction
{
    public static function move(ElectricVehicle $electricVehicle): void;
}