<?php

namespace Kata\City\Application\Validate;

use Kata\City\Domain\City;
use Kata\ElectricVehicle\Domain\ElectricVehicle;

final class CityValidator
{
    public function isElectricVehicleOutOfCityBoundaries(ElectricVehicle $electricVehicle, City $city): bool
    {
        if (
            $electricVehicle->getCoordinateX()->getValue() > $city->getLimitX()->getValue() ||
            $electricVehicle->getCoordinateY()->getValue() > $city->getLimitY()->getValue() ||
            $electricVehicle->getCoordinateX()->getValue() < 0 ||
            $electricVehicle->getCoordinateY()->getValue() < 0
        ) {
            return true;
        }

        return false;
    }
}