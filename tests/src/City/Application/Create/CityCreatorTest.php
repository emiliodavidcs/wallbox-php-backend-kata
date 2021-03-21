<?php

namespace Kata\Tests\src\City\Application\Create;

use Kata\City\Application\Create\CityCreator;
use Kata\City\Domain\City;
use Kata\City\Domain\CityLimitX;
use Kata\City\Domain\CityLimitY;
use PHPUnit\Framework\TestCase;

class CityCreatorTest extends TestCase
{
    public function testCreate()
    {
        // arrange
        $cityLimitX = new CityLimitX(rand(1, 1000));
        $cityLimitY = new CityLimitY(rand(1, 1000));

        // act
        $city = CityCreator::create($cityLimitX, $cityLimitY);

        // assert
        self::assertInstanceOf(City::class, $city);
    }
}