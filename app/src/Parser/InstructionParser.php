<?php

namespace Kata\App\Parser;

use Kata\App\DTO\InstructionDTO;
use Kata\Shared\Domain\DomainParser;

class InstructionParser implements DomainParser
{
    public function parse($data): InstructionDTO
    {
        $instructionDTO = new InstructionDTO();

        $instructionDTO
            ->setMovement($data);

        return $instructionDTO;
    }
}