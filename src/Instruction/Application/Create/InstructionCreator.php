<?php

namespace Kata\Instruction\Application\Create;

use Kata\Instruction\Domain\InstructionMovement;
use Kata\Instruction\Domain\Instruction;

class InstructionCreator
{
    public static function create(InstructionMovement $instructionMovement): Instruction
    {
        return new Instruction($instructionMovement);
    }
}