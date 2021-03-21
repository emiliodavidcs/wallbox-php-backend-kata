<?php

namespace Kata\App\Parser;

use Kata\App\DTO\ElectricVehicleDTO;
use Kata\App\DTO\NavigationDTO;
use Kata\Shared\Domain\DomainParser;

class NavigationParser implements DomainParser
{
    private $cityParser;
    private $positionParser;
    private $instructionParser;

    public function __construct(
        CityParser $cityParser,
        PositionParser $positionParser,
        InstructionParser $instructionParser
    ) {
        $this->cityParser = $cityParser;
        $this->positionParser = $positionParser;
        $this->instructionParser = $instructionParser;
    }

    public function parse($data): NavigationDTO
    {
        $navigationDTO = new NavigationDTO;

        $cityDTO = $this->cityParser->parse(array_shift($data));

        $electricVehicleDTOs = [];

        for ($i = 0; $i < count($data); $i += 2) {
            $positionDTO = $this->positionParser->parse($data[$i]);
            $instructions = str_split($data[$i + 1]);
            $instructionDTOs = [];
            foreach ($instructions as $instruction) {
                $instructionDTOs[] = $this->instructionParser->parse($instruction);
            }

            $electricVehicleDTO = new ElectricVehicleDTO();
            $electricVehicleDTO->setPosition($positionDTO);
            $electricVehicleDTO->setInstructions($instructionDTOs);

            $electricVehicleDTOs[] = $electricVehicleDTO;
        }

        $navigationDTO
            ->setCity($cityDTO)
            ->setElectricVehicles($electricVehicleDTOs);

        return $navigationDTO;
    }
}