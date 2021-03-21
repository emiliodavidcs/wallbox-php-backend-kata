<?php

namespace Kata\Instruction\Domain;

use Kata\Shared\Domain\DomainCollection;

class InstructionCollection extends DomainCollection
{
    public function getType()
    {
        return Instruction::class;
    }
}