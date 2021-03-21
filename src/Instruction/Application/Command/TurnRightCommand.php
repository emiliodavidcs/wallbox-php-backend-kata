<?php

namespace Kata\Instruction\Application\Command;

use Kata\ElectricVehicle\Application\Move\ElectricVehicleTurnRight;

class TurnRightCommand extends MovementCommand
{
    public function execute()
    {
        ElectricVehicleTurnRight::move($this->electricVehicle);
    }
}