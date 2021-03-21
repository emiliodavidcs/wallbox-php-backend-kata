<?php

namespace Kata\Tests\src\ElectricVehicle\Application\Validate;

use Kata\ElectricVehicle\Application\Validate\ElectricVehicleValidator;
use Kata\ElectricVehicle\Domain\ElectricVehicleCollection;
use Kata\Tests\Util\ElectricVehicleModelGenerator;
use PHPUnit\Framework\TestCase;

class ElectricVehicleValidatorTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testIsElectricVehicleInSamePositionAsAnyOther(array $electricVehicleCoordinates, array $otherElectricVehiclesCoordinates, bool $expectedRes)
    {
        // arrange
        $electricVehicleValidator = new ElectricVehicleValidator();

        $electricVehicleCollection = new ElectricVehicleCollection([]);

        $electricVehicle = ElectricVehicleModelGenerator::generate(['coordinateX' => $electricVehicleCoordinates[0], 'coordinateY' => $electricVehicleCoordinates[1]]);
        $electricVehicleCollection->pushItem($electricVehicle);

        foreach ($otherElectricVehiclesCoordinates as $otherElectricVehicleCoordinates) {
            $electricVehicleCollection->pushItem(
                ElectricVehicleModelGenerator::generate(['coordinateX' => $otherElectricVehicleCoordinates[0], 'coordinateY' => $otherElectricVehicleCoordinates[1]])
            );
        }

        // act
        $res = $electricVehicleValidator->isElectricVehicleInSamePositionAsAnyOther($electricVehicle, $electricVehicleCollection);

        // assert
        self::assertEquals($expectedRes, $res);
    }

    public function provider()
    {
        return [
            [[5, 5], [[5, 6], [6, 5]], false],
            [[5, 5], [[8, 9], [5, 5]], true],
            [[5, 5], [[5, 5], [2, 4]], true],
        ];
    }
}