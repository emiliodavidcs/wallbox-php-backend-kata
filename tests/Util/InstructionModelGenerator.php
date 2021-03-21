<?php

namespace Kata\Tests\Util;

use Kata\Instruction\Domain\Instruction;
use Kata\Instruction\Domain\InstructionMovement;

class InstructionModelGenerator implements ModelGenerator
{
    public static function generate(array $with): Instruction
    {
        $instructionMovement = new InstructionMovement($with['movement'] ?? InstructionMovement::randomValue());

        $instruction = new Instruction($instructionMovement);

        return $instruction;
    }
}