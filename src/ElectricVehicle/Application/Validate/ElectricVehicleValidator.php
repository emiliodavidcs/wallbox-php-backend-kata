<?php

namespace Kata\ElectricVehicle\Application\Validate;

use Kata\ElectricVehicle\Domain\ElectricVehicle;
use Kata\ElectricVehicle\Domain\ElectricVehicleCollection;

final class ElectricVehicleValidator
{
    public function isElectricVehicleInSamePositionAsAnyOther(
        ElectricVehicle $electricVehicle,
        ElectricVehicleCollection $electricVehicleCollection
    ): bool {
        /** @var ElectricVehicle $otherElectricVehicle */
        foreach ($electricVehicleCollection->getItems() as $otherElectricVehicle) {
            if (
                $otherElectricVehicle !== $electricVehicle &&
                $electricVehicle->getCoordinateX()->getValue() === $otherElectricVehicle->getCoordinateX()->getValue() &&
                $electricVehicle->getCoordinateY()->getValue() === $otherElectricVehicle->getCoordinateY()->getValue()
            ) {
                return true;
            }
        }

        return false;
    }
}