<?php

namespace Kata\App\Parser;

use Kata\App\DTO\PositionDTO;
use Kata\Shared\Domain\DomainParser;

class PositionParser implements DomainParser
{
    public function parse($data): PositionDTO
    {
        $positionDTO = new PositionDTO();

        $position = explode(' ', $data);

        $positionDTO
            ->setCoordinateX($position[0])
            ->setCoordinateY($position[1])
            ->setOrientation($position[2]);

        return $positionDTO;
    }
}