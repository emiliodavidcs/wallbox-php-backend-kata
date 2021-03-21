<?php

namespace Kata\City\Application\Create;

use Kata\City\Domain\City;
use Kata\City\Domain\CityLimitX;
use Kata\City\Domain\CityLimitY;

final class CityCreator
{
    public static function create(CityLimitX $cityLimitX, CityLimitY $cityLimitY): City
    {
        return new City($cityLimitX, $cityLimitY);
    }
}