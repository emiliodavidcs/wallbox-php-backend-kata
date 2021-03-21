<?php

namespace Kata\City\Domain;

use Kata\Shared\Domain\DomainError;

final class InvalidCityLimit extends DomainError
{
    public function getErrorMessage(): string
    {
        return 'The city limit is not valid';
    }
}