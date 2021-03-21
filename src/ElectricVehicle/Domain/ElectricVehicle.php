<?php

namespace Kata\ElectricVehicle\Domain;

use Kata\Instruction\Domain\InstructionCollection;

final class ElectricVehicle
{
    private $coordinateX;
    private $coordinateY;
    private $orientation;
    private $instructionCollection;

    public function __construct(
        ElectricVehicleCoordinateX $coordinateX,
        ElectricVehicleCoordinateY $coordinateY,
        ElectricVehicleOrientation $orientation,
        InstructionCollection $instructionCollection
    ) {
        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
        $this->orientation = $orientation;
        $this->instructionCollection = $instructionCollection;
    }

    public function getCoordinateX(): ElectricVehicleCoordinateX
    {
        return $this->coordinateX;
    }

    public function setCoordinateX(ElectricVehicleCoordinateX $coordinateX): self
    {
        $this->coordinateX = $coordinateX;
        return $this;
    }

    public function getCoordinateY(): ElectricVehicleCoordinateY
    {
        return $this->coordinateY;
    }

    public function setCoordinateY(ElectricVehicleCoordinateY $coordinateY): self
    {
        $this->coordinateY = $coordinateY;
        return $this;
    }

    public function getOrientation(): ElectricVehicleOrientation
    {
        return $this->orientation;
    }

    public function setOrientation(ElectricVehicleOrientation $orientation): self
    {
        $this->orientation = $orientation;
        return $this;
    }

    public function getInstructionCollection(): InstructionCollection
    {
        return $this->instructionCollection;
    }
}