<?php

namespace Kata\City\Domain;

final class City
{
    private $limitX;

    private $limitY;

    public function __construct(
        CityLimitX $limitX,
        CityLimitY $limitY
    ) {
        $this->limitX = $limitX;
        $this->limitY = $limitY;
    }

    public function getLimitX(): CityLimitX
    {
        return $this->limitX;
    }

    public function getLimitY(): CityLimitY
    {
        return $this->limitY;
    }
}