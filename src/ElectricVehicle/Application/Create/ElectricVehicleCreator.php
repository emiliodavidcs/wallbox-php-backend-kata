<?php

namespace Kata\ElectricVehicle\Application\Create;

use Kata\ElectricVehicle\Domain\ElectricVehicle;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateX;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateY;
use Kata\ElectricVehicle\Domain\ElectricVehicleOrientation;
use Kata\Instruction\Domain\InstructionCollection;

final class ElectricVehicleCreator
{
    public static function create(
        ElectricVehicleCoordinateX $coordinateX,
        ElectricVehicleCoordinateY $coordinateY,
        ElectricVehicleOrientation $orientation,
        InstructionCollection $instructionCollection
    ): ElectricVehicle {
        return new ElectricVehicle($coordinateX, $coordinateY, $orientation, $instructionCollection);
    }
}