<?php

namespace Kata\Instruction\Application\Command;

use Kata\ElectricVehicle\Application\Move\ElectricVehicleTurnLeft;

class TurnLeftCommand extends MovementCommand
{
    public function execute()
    {
        ElectricVehicleTurnLeft::move($this->electricVehicle);
    }
}