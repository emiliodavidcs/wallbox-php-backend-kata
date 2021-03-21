<?php

namespace Kata\App\DTO;

class ElectricVehicleDTO
{
    private $position;

    private $instructions;

    public function getPosition(): PositionDTO
    {
        return $this->position;
    }

    public function setPosition(PositionDTO $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function getInstructions(): array
    {
        return $this->instructions;
    }

    public function setInstructions(array $instructions): self
    {
        $this->instructions = $instructions;
        return $this;
    }


}