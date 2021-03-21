<?php

namespace Kata\Tests\src\ElectricVehicle\Application\Create;

use Kata\ElectricVehicle\Application\Create\ElectricVehicleCreator;
use Kata\ElectricVehicle\Domain\ElectricVehicle;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateX;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateY;
use Kata\ElectricVehicle\Domain\ElectricVehicleOrientation;
use Kata\Instruction\Domain\InstructionCollection;
use PHPUnit\Framework\TestCase;

class ElectricVehicleCreatorTest extends TestCase
{
    public function testCreate()
    {
        // arrange
        $electricVehicleCoordinateX = new ElectricVehicleCoordinateX(rand(0, 1000));
        $electricVehicleCoordinateY = new ElectricVehicleCoordinateY(rand(0, 1000));
        $electricVehicleOrientation = new ElectricVehicleOrientation(ElectricVehicleOrientation::randomValue());
        $instructionCollection = new InstructionCollection([]);

        // act
        $electricVehicle = ElectricVehicleCreator::create($electricVehicleCoordinateX, $electricVehicleCoordinateY, $electricVehicleOrientation, $instructionCollection);

        // assert
        self::assertInstanceOf(ElectricVehicle::class, $electricVehicle);
    }
}