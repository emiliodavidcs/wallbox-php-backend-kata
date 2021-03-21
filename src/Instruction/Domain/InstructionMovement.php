<?php

namespace Kata\Instruction\Domain;

use Kata\Instruction\Application\Command\MovementCommand;
use Kata\Shared\Domain\ValueObject\EnumValueObject;

class InstructionMovement extends EnumValueObject
{
    const MOVE = 'M';
    const LEFT = 'L';
    const RIGHT = 'R';

    protected function throwExceptionForInvalidValue($value)
    {
        throw new InvalidInstructionMovement($value);
    }

    public function executeCommand(MovementCommand $command)
    {
        $command->execute();
    }
}