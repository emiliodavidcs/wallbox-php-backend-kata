<?php

namespace Kata\ElectricVehicle\Application\Move;

use Kata\ElectricVehicle\Domain\ElectricVehicle;
use Kata\ElectricVehicle\Domain\ElectricVehicleOrientation;

abstract class ElectricVehicleTurnRight implements ElectricVehicleMovementAction
{
    public static function move(ElectricVehicle $electricVehicle): void
    {
        switch ($electricVehicle->getOrientation()) {
            case ElectricVehicleOrientation::NORTH:
                $electricVehicle->setOrientation(ElectricVehicleOrientation::fromString(ElectricVehicleOrientation::EAST));
                break;
            case ElectricVehicleOrientation::EAST:
                $electricVehicle->setOrientation(ElectricVehicleOrientation::fromString(ElectricVehicleOrientation::SOUTH));
                break;
            case ElectricVehicleOrientation::SOUTH:
                $electricVehicle->setOrientation(ElectricVehicleOrientation::fromString(ElectricVehicleOrientation::WEST));
                break;
            case ElectricVehicleOrientation::WEST:
                $electricVehicle->setOrientation(ElectricVehicleOrientation::fromString(ElectricVehicleOrientation::NORTH));
                break;
        }
    }
}