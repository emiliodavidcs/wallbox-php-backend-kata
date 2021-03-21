<?php

namespace Kata\Instruction\Application\Command;

use Kata\ElectricVehicle\Domain\ElectricVehicle;
use Kata\Instruction\Domain\InstructionMovement;

abstract class MovementCommand
{
    protected $instructionMovement;

    protected $electricVehicle;

    public function __construct(InstructionMovement $instructionMovement, ElectricVehicle $electricVehicle)
    {
        $this->instructionMovement= $instructionMovement;
        $this->electricVehicle = $electricVehicle;
    }

    public abstract function execute();
}