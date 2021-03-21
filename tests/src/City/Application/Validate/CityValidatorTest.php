<?php

namespace Kata\Tests\src\City\Application\Validate;

use Kata\City\Application\Validate\CityValidator;
use Kata\Tests\Util\CityModelGenerator;
use Kata\Tests\Util\ElectricVehicleModelGenerator;
use PHPUnit\Framework\TestCase;

class CityValidatorTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testIsElectricVehicleOutOfCityBoundaries(array $cityLimits, array $electricVehicleCoordinates, bool $expectedRes)
    {
        // arrange
        $cityValidator = new CityValidator();

        $city = CityModelGenerator::generate(['limitX' => $cityLimits[0], 'limitY' => $cityLimits[1]]);
        $electricVehicle = ElectricVehicleModelGenerator::generate(['coordinateX' => $electricVehicleCoordinates[0], 'coordinateY' => $electricVehicleCoordinates[1]]);

        // act
        $res = $cityValidator->isElectricVehicleOutOfCityBoundaries($electricVehicle, $city);

        // assert
        self::assertEquals($expectedRes, $res);
    }

    public function provider()
    {
        return [
            [[10, 10], [5, 5], false],
            [[10, 10], [11, 8], true],
            [[10, 10], [0, 12], true],
            [[10, 10], [16, 20], true],
        ];
    }
}