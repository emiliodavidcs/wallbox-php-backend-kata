<?php

namespace Kata\App\DTO;

class NavigationDTO
{
    private $city;

    private $electricVehicles;

    public function getCity(): CityDTO
    {
        return $this->city;
    }

    public function setCity(CityDTO $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getElectricVehicles()
    {
        return $this->electricVehicles;
    }

    public function setElectricVehicles($electricVehicles)
    {
        $this->electricVehicles = $electricVehicles;
        return $this;
    }


}