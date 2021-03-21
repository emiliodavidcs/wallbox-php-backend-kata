<?php

namespace Kata\Tests\Util;

use Kata\City\Domain\City;
use Kata\City\Domain\CityLimitX;
use Kata\City\Domain\CityLimitY;

final class CityModelGenerator implements ModelGenerator
{
    public static function generate(array $with): City
    {
        $cityLimitX = new CityLimitX($with['limitX'] ?? rand(1, 1000));
        $cityLimitY = new CityLimitY($with['limitY'] ?? rand(1, 1000));

        $city = new City($cityLimitX, $cityLimitY);

        return $city;
    }
}