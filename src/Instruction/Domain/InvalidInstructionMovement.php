<?php

namespace Kata\Instruction\Domain;

use Kata\Shared\Domain\DomainError;

final class InvalidInstructionMovement extends DomainError
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;

        parent::__construct();
    }

    public function getErrorMessage(): string
    {
        return sprintf("The movement value '%s' is not valid", $this->value);
    }
}