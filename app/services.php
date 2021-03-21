<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Kata\App\Parser\CityParser;
use Kata\App\Parser\PositionParser;
use Kata\App\Parser\InstructionParser;
use Kata\App\Parser\NavigationParser;
use Kata\App\Service\NavigationService;
use Kata\City\Application\Validate\CityValidator;
use Kata\ElectricVehicle\Application\Validate\ElectricVehicleValidator;

$containerBuilder = new ContainerBuilder();

$containerBuilder->register('parser.city', CityParser::class);
$containerBuilder->register('parser.position', PositionParser::class);
$containerBuilder->register('parser.instruction', InstructionParser::class);
$containerBuilder
    ->register('parser.navigation', NavigationParser::class)
    ->addArgument(new Reference('parser.city'))
    ->addArgument(new Reference('parser.position'))
    ->addArgument(new Reference('parser.instruction'));

$containerBuilder->register('validator.city', CityValidator::class);
$containerBuilder->register('validator.electric_vehicle', ElectricVehicleValidator::class);
$containerBuilder
    ->register('service.navigation', NavigationService::class)
    ->addArgument(new Reference('validator.city'))
    ->addArgument(new Reference('validator.electric_vehicle'));