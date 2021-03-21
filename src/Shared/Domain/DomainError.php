<?php

namespace Kata\Shared\Domain;

use DomainException;

abstract class DomainError extends DomainException
{
    public function __construct()
    {
        parent::__construct($this->getErrorMessage());
    }

    abstract protected function getErrorMessage(): string;
}