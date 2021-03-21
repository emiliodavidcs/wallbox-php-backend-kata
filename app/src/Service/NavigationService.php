<?php

namespace Kata\App\Service;

use Kata\App\DTO\CityDTO;
use Kata\App\DTO\ElectricVehicleDTO;
use Kata\App\DTO\InstructionDTO;
use Kata\City\Application\Create\CityCreator;
use Kata\City\Application\Validate\CityValidator;
use Kata\City\Domain\City;
use Kata\City\Domain\CityLimitX;
use Kata\City\Domain\CityLimitY;
use Kata\City\Domain\InvalidCityLimit;
use Kata\City\Domain\OutOfBoundariesError;
use Kata\ElectricVehicle\Application\Create\ElectricVehicleCreator;
use Kata\ElectricVehicle\Application\Validate\ElectricVehicleValidator;
use Kata\ElectricVehicle\Domain\ElectricVehicle;
use Kata\ElectricVehicle\Domain\ElectricVehicleCollection;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateX;
use Kata\ElectricVehicle\Domain\ElectricVehicleCoordinateY;
use Kata\ElectricVehicle\Domain\ElectricVehicleOrientation;
use Kata\ElectricVehicle\Domain\InvalidElectricVehiclePosition;
use Kata\ElectricVehicle\Domain\ElectricVehicleCrashedError;
use Kata\Instruction\Application\Command\MoveForwardCommand;
use Kata\Instruction\Application\Command\TurnLeftCommand;
use Kata\Instruction\Application\Command\TurnRightCommand;
use Kata\Instruction\Application\Create\InstructionCreator;
use Kata\Instruction\Domain\Instruction;
use Kata\Instruction\Domain\InstructionCollection;
use Kata\Instruction\Domain\InstructionMovement;
use Symfony\Component\Console\Output\OutputInterface;
use TypeError;
use LogicException;

class NavigationService
{
    private $cityValidator;

    private $electricVehicleValidator;

    /** @var City|null */
    private $city;

    private $electricVehicleCollection;

    public function __construct(CityValidator $cityValidator, ElectricVehicleValidator $electricVehicleValidator)
    {
        $this->cityValidator = $cityValidator;
        $this->electricVehicleValidator = $electricVehicleValidator;
        $this->electricVehicleCollection = new ElectricVehicleCollection([]);
    }

    public function navigate(OutputInterface $output): void
    {
        /** @var ElectricVehicle $electricVehicle */
        foreach ($this->electricVehicleCollection->getItems() as $key => $electricVehicle) {
            $electricVehicleNumber = $key + 1;
            $output->writeln(sprintf('Initiating electric vehicle nº %d navigation', $electricVehicleNumber));

            /** @var Instruction $instruction */
            foreach ($electricVehicle->getInstructionCollection()->getItems() as $instruction) {
                switch ($instruction->getInstructionMovement()) {
                    case InstructionMovement::MOVE:
                        $command = new MoveForwardCommand($instruction->getInstructionMovement(), $electricVehicle);
                        break;
                    case InstructionMovement::LEFT:
                        $command = new TurnLeftCommand($instruction->getInstructionMovement(), $electricVehicle);
                        break;
                    case InstructionMovement::RIGHT:
                        $command = new TurnRightCommand($instruction->getInstructionMovement(), $electricVehicle);
                        break;
                    default:
                        throw new LogicException('This code should not be reached since InstructionMovement is an enum value');
                }
                $instruction->getInstructionMovement()->executeCommand($command);

                if ($this->cityValidator->isElectricVehicleOutOfCityBoundaries($electricVehicle, $this->city))  {
                    throw new OutOfBoundariesError();
                }

                if ($this->electricVehicleValidator->isElectricVehicleInSamePositionAsAnyOther($electricVehicle, $this->electricVehicleCollection)) {
                    throw new ElectricVehicleCrashedError();
                }
            }

            $output->writeln(sprintf('Electric vehicle nº %d finalized its navigation with coordinates [%d,%d] and orientation %s',
                $electricVehicleNumber,
                $electricVehicle->getCoordinateX()->getValue(),
                $electricVehicle->getCoordinateY()->getValue(),
                $electricVehicle->getOrientation()
            ));
        }
    }

    public function createCity(CityDTO $cityDTO, OutputInterface $output): void
    {
        try {
            $cityLimitX = new CityLimitX($cityDTO->getLimitX());
            $cityLimitY = new CityLimitY($cityDTO->getLimitY());
        } catch (TypeError $exception) {
            throw new InvalidCityLimit();
        }

        $this->city = CityCreator::create($cityLimitX, $cityLimitY);
        $output->writeln(sprintf('Created city with dimensions %d x %d', $this->city->getLimitX()->getValue(), $this->city->getLimitY()->getValue()));
    }

    public function deployElectricVehicle(ElectricVehicleDTO $electricVehicleDTO, OutputInterface $output): void
    {
        $output->writeln(sprintf('Deploying electric vehicle nº %d', count($this->electricVehicleCollection->getItems()) + 1));

        $instructionCollection = $this->generateInstructionsForElectricVehicle($electricVehicleDTO);

        try {
            $coordinateX = new ElectricVehicleCoordinateX($electricVehicleDTO->getPosition()->getCoordinateX());
            $coordinateY = new ElectricVehicleCoordinateY($electricVehicleDTO->getPosition()->getCoordinateY());
            $orientation = new ElectricVehicleOrientation($electricVehicleDTO->getPosition()->getOrientation());
        } catch (TypeError $exception) {
            throw new InvalidElectricVehiclePosition();
        }

        $electricVehicle = ElectricVehicleCreator::create($coordinateX, $coordinateY, $orientation, $instructionCollection);

        if ($this->cityValidator->isElectricVehicleOutOfCityBoundaries($electricVehicle, $this->city))  {
            throw new OutOfBoundariesError();
        }


        if ($this->electricVehicleValidator->isElectricVehicleInSamePositionAsAnyOther($electricVehicle, $this->electricVehicleCollection)) {
            throw new ElectricVehicleCrashedError();
        }

        $this->electricVehicleCollection->pushItem($electricVehicle);

        $output->writeln(sprintf('Deployed electric vehicle nº %d with coordinates [%d,%d] and orientation %s',
            count($this->electricVehicleCollection->getItems()),
            $electricVehicle->getCoordinateX()->getValue(),
            $electricVehicle->getCoordinateY()->getValue(),
            $electricVehicle->getOrientation()
        ));
    }

    public function generateInstructionsForElectricVehicle(ElectricVehicleDTO $electricVehicleDTO): InstructionCollection
    {
        $instructionCollection = new InstructionCollection([]);

        /** @var InstructionDTO $instructionDTO */
        foreach ($electricVehicleDTO->getInstructions() as $instructionDTO) {
            $instructionMovement = new InstructionMovement($instructionDTO->getMovement());

            $instruction = InstructionCreator::create($instructionMovement);

            $instructionCollection->pushItem($instruction);
        }

        return $instructionCollection;
    }
}