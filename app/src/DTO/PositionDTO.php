<?php

namespace Kata\App\DTO;

class PositionDTO
{
    private $coordinateX;

    private $coordinateY;

    private $orientation;

    public function getCoordinateX(): int
    {
        return $this->coordinateX;
    }

    public function setCoordinateX(int $coordinateX): self
    {
        $this->coordinateX = $coordinateX;
        return $this;
    }

    public function getCoordinateY(): int
    {
        return $this->coordinateY;
    }

    public function setCoordinateY(int $coordinateY): self
    {
        $this->coordinateY = $coordinateY;
        return $this;
    }

    public function getOrientation(): string
    {
        return $this->orientation;
    }

    public function setOrientation(string $orientation): self
    {
        $this->orientation = $orientation;
        return $this;
    }


}