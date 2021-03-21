<?php

namespace Kata\App\Command;

use Kata\App\Parser\NavigationParser;
use Kata\App\Service\NavigationService;
use Kata\ElectricVehicle\Domain\InvalidElectricVehiclePosition;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use TypeError;

class NavigationCommand extends Command
{
    const ARG_FILE = 'file';

    protected static $defaultName = 'app:electric-vehicle:navigation';

    private $navigationParser;
    private $navigationService;

    public function __construct(
        NavigationParser $navigationParser,
        NavigationService $navigationService,
        ?string $name = null
    ) {
        $this->navigationParser = $navigationParser;
        $this->navigationService = $navigationService;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Electric vehicles navigation.')
            ->addArgument(self::ARG_FILE, InputArgument::REQUIRED, 'Text file with coordinates and directions.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $content = trim(file_get_contents($input->getArgument(self::ARG_FILE)));
        $lines = explode("\n", $content);

        try {
            $navigationDTO = $this->navigationParser->parse($lines);
        } catch (TypeError $exception) {
            $output->writeln('Please provide an input file with valid values');
            return Command::FAILURE;
        }

        $this->navigationService->createCity($navigationDTO->getCity(), $output);

        foreach ($navigationDTO->getElectricVehicles() as $electricVehicleDTO) {
            try {
                $this->navigationService->deployElectricVehicle($electricVehicleDTO, $output);
            } catch (InvalidElectricVehiclePosition $exception) {
                $output->writeln('Invalid deployment position, skipping this vehicle');
            }
        }

        $this->navigationService->navigate($output);

        return Command::SUCCESS;
    }
}