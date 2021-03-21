<?php

namespace Kata\App\DTO;

class InstructionDTO
{
    private $movement;

    public function getMovement(): string
    {
        return $this->movement;
    }

    public function setMovement(string $movement): self
    {
        $this->movement = $movement;
        return $this;
    }
}