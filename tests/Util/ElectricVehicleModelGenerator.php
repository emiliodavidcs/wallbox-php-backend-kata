<?php

namespace Kata\Tests\Util;

use Kata\ElectricVehicle\Domain\ElectricVehicle;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateX;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateY;
use Kata\ElectricVehicle\Domain\ElectricVehicleOrientation;
use Kata\Instruction\Domain\InstructionCollection;

class ElectricVehicleModelGenerator implements ModelGenerator
{
    public static function generate(array $with): ElectricVehicle
    {
        $coordinateX = new ElectricVehicleCoordinateX($with['coordinateX'] ?? rand(1, 1000));
        $coordinateY = new ElectricVehicleCoordinateY($with['coordinateY'] ?? rand(1, 1000));
        $orientation = new ElectricVehicleOrientation($with['orientation'] ?? ElectricVehicleOrientation::randomValue());
        $instructionCollection = new InstructionCollection([]);

        $electricVehicle = new ElectricVehicle($coordinateX, $coordinateY, $orientation, $instructionCollection);

        return $electricVehicle;
    }
}