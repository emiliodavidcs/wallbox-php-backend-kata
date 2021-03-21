<?php

namespace Kata\App\DTO;

class CityDTO
{
    private $limitX;

    private $limitY;

    public function getLimitX(): int
    {
        return $this->limitX;
    }

    public function setLimitX(int $limitX): self
    {
        $this->limitX = $limitX;
        return $this;
    }

    public function getLimitY(): int
    {
        return $this->limitY;
    }

    public function setLimitY(int $limitY)
    {
        $this->limitY = $limitY;
        return $this;
    }
}