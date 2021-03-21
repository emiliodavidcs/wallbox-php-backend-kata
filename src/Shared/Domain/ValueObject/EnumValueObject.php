<?php

namespace Kata\Shared\Domain\ValueObject;

use ReflectionClass;

abstract class EnumValueObject
{
    protected $value;

    public function __construct($value)
    {
        $this->validateIsAcceptedValue($value);

        $this->value = $value;
    }

    abstract protected function throwExceptionForInvalidValue($value);

    public static function values(): array
    {
        $reflected = new ReflectionClass(static::class);

        return $reflected->getConstants();
    }

    private function validateIsAcceptedValue($value): void
    {
        if (!in_array($value, static::values(), true)) {
            $this->throwExceptionForInvalidValue($value);
        }
    }

    public static function fromString(string $value): EnumValueObject
    {
        return new static($value);
    }

    public function getValue()
    {
        return $this->value;
    }

    public static function randomValue()
    {
        return self::values()[array_rand(self::values())];
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}