<?php

namespace Kata\City\Domain;

use Kata\Shared\Domain\DomainError;

final class OutOfBoundariesError extends DomainError
{
    public function getErrorMessage(): string
    {
        return 'It is not valid to operate out of city boundaries';
    }
}