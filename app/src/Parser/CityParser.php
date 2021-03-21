<?php

namespace Kata\App\Parser;

use Kata\App\DTO\CityDTO;
use Kata\Shared\Domain\DomainParser;

class CityParser implements DomainParser
{
    public function parse($data): CityDTO
    {
        $areaDTO = new CityDTO();

        $area = explode(' ', $data);

        $areaDTO
            ->setLimitX($area[0])
            ->setLimitY($area[1]);

        return $areaDTO;
    }
}