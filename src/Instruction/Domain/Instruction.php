<?php

namespace Kata\Instruction\Domain;

final class Instruction
{
    private $instructionMovement;

    public function __construct(InstructionMovement $instructionMovement)
    {
        $this->instructionMovement = $instructionMovement;
    }

    public function getInstructionMovement() : InstructionMovement
    {
        return $this->instructionMovement;
    }
}