<?php

namespace Kata\Tests\app\src\Parser;

use Kata\App\DTO\CityDTO;
use Kata\App\DTO\InstructionDTO;
use Kata\App\DTO\PositionDTO;
use Kata\App\Parser\CityParser;
use Kata\App\Parser\InstructionParser;
use Kata\App\Parser\NavigationParser;
use Kata\App\Parser\PositionParser;
use Kata\ElectricVehicle\Domain\ElectricVehicleOrientation;
use Kata\Instruction\Domain\InstructionMovement;
use PHPUnit\Framework\TestCase;

class NavigationParserTest extends TestCase
{
    public function testParse()
    {
        // arrange
        $cityParser = $this->createMock(CityParser::class);
        $cityDTO = new CityDTO();
        $cityDTO->setLimitX(rand(1, 1000));
        $cityDTO->setLimitY(rand(1, 1000));
        $cityParser
            ->method('parse')
            ->willReturn($cityDTO);

        $positionParser = $this->createMock(PositionParser::class);
        $positionDTO1 = new PositionDTO();
        $positionDTO1->setCoordinateX(rand(0, 1000));
        $positionDTO1->setCoordinateY(rand(0, 1000));
        $positionDTO1->setOrientation(ElectricVehicleOrientation::randomValue());
        $positionDTO2 = new PositionDTO();
        $positionDTO2->setCoordinateX(rand(0, 1000));
        $positionDTO2->setCoordinateY(rand(0, 1000));
        $positionDTO2->setOrientation(ElectricVehicleOrientation::randomValue());
        $positionParser
            ->method('parse')
            ->will($this->onConsecutiveCalls($positionDTO1, $positionDTO2));

        $instructionParser = $this->createMock(InstructionParser::class);
        $instructionDTO = new InstructionDTO();
        $instructionDTO->setMovement(InstructionMovement::randomValue());
        $instructionParser
            ->method('parse')
            ->willReturn($instructionDTO);

        $data = [
            'City information Mock',
            'Electric Vehicle 1 Position Mock',
            'Electric Vehicle 1 Instructions Mock',
            'Electric Vehicle 2 Position Mock',
            'Electric Vehicle 1 Instructions Mock',
        ];

        $navigationParser = new NavigationParser($cityParser, $positionParser, $instructionParser);

        // act
        $navigationDTO = $navigationParser->parse($data);

        // assert
        self::assertEquals($cityDTO, $navigationDTO->getCity());

        $electricVehicleDTOs = $navigationDTO->getElectricVehicles();

        self::assertCount(2, $electricVehicleDTOs);

        self::assertEquals($positionDTO1, $electricVehicleDTOs[0]->getPosition());
        self::assertEquals($instructionDTO, $electricVehicleDTOs[0]->getInstructions()[0]);

        self::assertEquals($positionDTO2, $electricVehicleDTOs[1]->getPosition());
        self::assertEquals($instructionDTO, $electricVehicleDTOs[1]->getInstructions()[0]);
    }
}