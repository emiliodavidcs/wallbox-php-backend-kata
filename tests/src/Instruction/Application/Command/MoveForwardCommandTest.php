<?php

namespace Kata\Tests\src\Instruction\Application\Command;

use Kata\ElectricVehicle\Domain\ElectricVehicle;
use Kata\ElectricVehicle\Domain\ElectricVehicleOrientation;
use Kata\Instruction\Application\Command\MoveForwardCommand;
use Kata\Instruction\Domain\InstructionMovement;
use Kata\Tests\Util\ElectricVehicleModelGenerator;
use Kata\Tests\Util\InstructionModelGenerator;
use PHPUnit\Framework\TestCase;

class MoveForwardCommandTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testExecute(array $initialPosition, array $expectedPosition)
    {
        // arrange
        /** @var ElectricVehicle $electricVehicle */
        $electricVehicle = ElectricVehicleModelGenerator::generate($initialPosition);

        $instruction = InstructionModelGenerator::generate(['movement' => InstructionMovement::MOVE]);

        $moveForwardCommand = new MoveForwardCommand($instruction->getInstructionMovement(), $electricVehicle);

        // act
        $moveForwardCommand->execute();

        // assert
        self::assertEquals($expectedPosition['coordinateX'], $electricVehicle->getCoordinateX()->getValue());
        self::assertEquals($expectedPosition['coordinateY'], $electricVehicle->getCoordinateY()->getValue());
        self::assertEquals($expectedPosition['orientation'], $electricVehicle->getOrientation()->getValue());
    }

    public function provider()
    {
        $initialCoordinateX = rand(1, 1000);
        $initialCoordinateY = rand(1, 1000);
        return [
            [
                [
                    'coordinateX' => $initialCoordinateX,
                    'coordinateY' => $initialCoordinateY,
                    'orientation' => ElectricVehicleOrientation::NORTH,
                ],
                [
                    'coordinateX' => $initialCoordinateX,
                    'coordinateY' => $initialCoordinateY + 1,
                    'orientation' => ElectricVehicleOrientation::NORTH,
                ],
            ],
            [
                [
                    'coordinateX' => $initialCoordinateX,
                    'coordinateY' => $initialCoordinateY,
                    'orientation' => ElectricVehicleOrientation::EAST,
                ],
                [
                    'coordinateX' => $initialCoordinateX + 1,
                    'coordinateY' => $initialCoordinateY,
                    'orientation' => ElectricVehicleOrientation::EAST,
                ],
            ],
            [
                [
                    'coordinateX' => $initialCoordinateX,
                    'coordinateY' => $initialCoordinateY,
                    'orientation' => ElectricVehicleOrientation::SOUTH,
                ],
                [
                    'coordinateX' => $initialCoordinateX,
                    'coordinateY' => $initialCoordinateY - 1,
                    'orientation' => ElectricVehicleOrientation::SOUTH,
                ],
            ],
            [
                [
                    'coordinateX' => $initialCoordinateX,
                    'coordinateY' => $initialCoordinateY,
                    'orientation' => ElectricVehicleOrientation::WEST,
                ],
                [
                    'coordinateX' => $initialCoordinateX - 1,
                    'coordinateY' => $initialCoordinateY,
                    'orientation' => ElectricVehicleOrientation::WEST,
                ],
            ],
        ];
    }
}