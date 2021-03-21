<?php

namespace Kata\Shared\Domain\ValueObject;

abstract class IntValueObject
{
    protected  $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}