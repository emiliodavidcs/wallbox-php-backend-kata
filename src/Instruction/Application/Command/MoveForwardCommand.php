<?php

namespace Kata\Instruction\Application\Command;

use Kata\ElectricVehicle\Application\Move\ElectricVehicleMoveForward;

class MoveForwardCommand extends MovementCommand
{
    public function execute()
    {
        ElectricVehicleMoveForward::move($this->electricVehicle);
    }
}