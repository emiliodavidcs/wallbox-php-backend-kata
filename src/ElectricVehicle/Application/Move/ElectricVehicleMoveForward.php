<?php

namespace Kata\ElectricVehicle\Application\Move;

use Kata\ElectricVehicle\Domain\ElectricVehicle;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateX;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateY;
use Kata\ElectricVehicle\Domain\ElectricVehicleOrientation;

abstract class ElectricVehicleMoveForward implements ElectricVehicleMovementAction
{
    public static function move(ElectricVehicle $electricVehicle): void
    {
        switch ($electricVehicle->getOrientation()) {
            case ElectricVehicleOrientation::NORTH:
                $electricVehicle->setCoordinateY(new ElectricVehicleCoordinateY($electricVehicle->getCoordinateY()->getValue() + 1));
                break;
            case ElectricVehicleOrientation::EAST:
                $electricVehicle->setCoordinateX(new ElectricVehicleCoordinateX($electricVehicle->getCoordinateX()->getValue() + 1));
                break;
            case ElectricVehicleOrientation::SOUTH:
                $electricVehicle->setCoordinateY(new ElectricVehicleCoordinateY($electricVehicle->getCoordinateY()->getValue() - 1));
                break;
            case ElectricVehicleOrientation::WEST:
                $electricVehicle->setCoordinateX(new ElectricVehicleCoordinateX($electricVehicle->getCoordinateX()->getValue() - 1));
                break;
        }
    }
}